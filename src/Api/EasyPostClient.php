<?php

declare(strict_types=1);

namespace Odiseo\SyliusEasyPostPlugin\Api;

use Doctrine\Common\Collections\Collection;
use EasyPost\EasyPost;
use EasyPost\Error;
use EasyPost\Rate;
use EasyPost\Shipment;
use Odiseo\SyliusEasyPostPlugin\Entity\EasyPostAwareInterface;
use Odiseo\SyliusEasyPostPlugin\Entity\EasyPostConfigurationInterface;
use Odiseo\SyliusEasyPostPlugin\Entity\EasyPostConfigurationSenderDataInterface;
use Odiseo\SyliusEasyPostPlugin\Provider\EnabledEasyPostConfigurationProviderInterface;
use Sylius\Component\Core\Model\AddressInterface;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Core\Model\OrderItemInterface;
use Sylius\Component\Core\Model\ShipmentInterface;

class EasyPostClient
{
    private EasyPostConfigurationInterface $easyPostConfiguration;

    public function __construct(
        private EnabledEasyPostConfigurationProviderInterface $enabledEasyPostConfigurationProvider,
    ) {
        $easyPostConfiguration = $this->enabledEasyPostConfigurationProvider->getConfiguration();
        if (!$easyPostConfiguration instanceof EasyPostConfigurationInterface) {
            throw new Error(
                sprintf('The "%s" has not been found', EasyPostConfigurationInterface::class),
            );
        }

        $this->easyPostConfiguration = $easyPostConfiguration;
    }

    public function createShipment(OrderInterface $order): ?Shipment
    {
        $shippingAddress = $order->getShippingAddress();
        $items = $order->getItems();
        if (null === $shippingAddress || $items->isEmpty()) {
            return null;
        }

        try {
            $this->setApiKey();

            /** @var Shipment $shipment */
            $shipment = Shipment::create([
                'from_address' => $this->getFromAddress(),
                'to_address' => $this->getToAddress($shippingAddress),
                'parcel' => $this->getParcel($items),
            ]);

            return $shipment;
        } catch (Error $exception) {
            return null;
        }
    }

    public function getShipment(string $id): ?Shipment
    {
        try {
            $this->setApiKey();

            /** @var Shipment $shipment */
            $shipment = Shipment::retrieve($id);

            return $shipment;
        } catch (Error $exception) {
            return null;
        }
    }

    public function getRate(string $id): ?Rate
    {
        try {
            $this->setApiKey();

            /** @var Rate $rate */
            $rate = Rate::retrieve($id);

            return $rate;
        } catch (Error $exception) {
            return null;
        }
    }

    public function getRates(ShipmentInterface $subject): array
    {
        if (!$subject instanceof EasyPostAwareInterface) {
            return [];
        }

        $shipmentId = $subject->getShipmentId();
        if (null === $shipmentId) {
            return [];
        }

        $shipment = $this->getShipment($shipmentId);
        if (null === $shipment) {
            return [];
        }

        return $shipment->rates;
    }

    public function buyShipment(ShipmentInterface $subject): ?Shipment
    {
        if (!$subject instanceof EasyPostAwareInterface) {
            return null;
        }

        $shipmentId = $subject->getShipmentId();
        if (null === $shipmentId) {
            return null;
        }

        $shipment = $this->getShipment($shipmentId);
        if (null === $shipment) {
            return null;
        }

        $rateId = $subject->getRateId();
        if (null === $rateId) {
            return null;
        }

        $rate = $this->getRate($rateId);
        if (null === $rate) {
            return null;
        }

        try {
            $this->setApiKey();

            return $shipment->buy($rate);
        } catch (Error $exception) {
            return null;
        }
    }

    /**
     * @psalm-param Collection<array-key, OrderItemInterface> $items
     */
    private function getParcel(Collection $items): array
    {
        $length = 0;
        $width = 0;
        $height = 0;
        $weight = 0;

        foreach ($items as $item) {
            $length += (float) $item->getVariant()?->getDepth();
            $width += (float) $item->getVariant()?->getWidth();
            $height += (float) $item->getVariant()?->getHeight();
            $weight += (float) $item->getVariant()?->getWeight();
        }

        return [
            'length' => $length,
            'width' => $width,
            'height' => $height,
            'weight' => $weight,
        ];
    }

    private function getFromAddress(): array
    {
        /** @var EasyPostConfigurationInterface $configuration */
        $configuration = $this->enabledEasyPostConfigurationProvider->getConfiguration();

        $senderData = $configuration->getSenderData();
        if (!$senderData instanceof EasyPostConfigurationSenderDataInterface) {
            return [];
        }

        return [
            'name' => $senderData->getFullName(),
            'company' => $senderData->getCompany(),
            'street1' => $senderData->getStreet(),
            'city' => $senderData->getCity(),
            'country' => $senderData->getCountryCode(),
            'state' => $senderData->getProvinceCode() ?? $senderData->getProvinceName(),
            'zip' => $senderData->getPostcode(),
            'phone' => $senderData->getPhoneNumber(),
        ];
    }

    private function getToAddress(AddressInterface $shippingAddress): array
    {
        return [
            'name' => $shippingAddress->getFullName(),
            'company' => $shippingAddress->getCompany(),
            'street1' => $shippingAddress->getStreet(),
            'city' => $shippingAddress->getCity(),
            'country' => $shippingAddress->getCountryCode(),
            'state' => $shippingAddress->getProvinceCode() ?? $shippingAddress->getProvinceName(),
            'zip' => $shippingAddress->getPostcode(),
            'phone' => $shippingAddress->getPhoneNumber(),
        ];
    }

    private function setApiKey(): void
    {
        $apiKey = (string) $this->easyPostConfiguration->getApiKey();

        EasyPost::setApiKey($apiKey);
    }
}
