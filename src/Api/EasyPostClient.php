<?php

declare(strict_types=1);

namespace Odiseo\SyliusEasyPostPlugin\Api;

use Doctrine\Common\Collections\Collection;
use EasyPost\EasyPost;
use EasyPost\Error;
use EasyPost\Rate;
use EasyPost\Shipment;
use Odiseo\SyliusEasyPostPlugin\Entity\EasyPostConfigurationInterface;
use Odiseo\SyliusEasyPostPlugin\Provider\EnabledEasyPostConfigurationProviderInterface;
use Sylius\Component\Core\Model\AddressInterface;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Core\Model\OrderItemInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EasyPostClient
{
    public function __construct(
        private EnabledEasyPostConfigurationProviderInterface $enabledEasyPostConfigurationProvider,
    ) {
        $easyPostConfiguration = $this->enabledEasyPostConfigurationProvider->getConfiguration();
        if (!$easyPostConfiguration instanceof EasyPostConfigurationInterface) {
            throw new NotFoundHttpException(
                sprintf('The "%s" has not been found', EasyPostConfigurationInterface::class),
            );
        }

        $apiKey = (string) $easyPostConfiguration->getApiKey();

        EasyPost::setApiKey($apiKey);
    }

    public function buyShipment(Rate $rate): Shipment
    {
        $shipmentId = $rate->shipment_id;
        $shipment = $this->getShipment($shipmentId);

        if (null === $shipment->selected_rate) {
            $shipment->buy($rate);
        }

        return $shipment;
    }

    public function getSelectedRate($id): Rate
    {
        $rate = Rate::retrieve($id);

        return $rate;
    }

    public function getRates(OrderInterface $order): array
    {
        $shippingAddress = $order->getShippingAddress();
        $items = $order->getItems();
        if (null === $shippingAddress || $items->isEmpty()) {
            return [];
        }

        try {
            /** @var Shipment $shipment */
            $shipment = Shipment::create([
                'from_address' => $this->getFromAddress(),
                'to_address' => $this->getToAddress($shippingAddress),
                'parcel' => $this->getParcel($items),
            ]);

            return $shipment->rates;
        } catch (Error $exception) {
            throw $exception;
        }
    }

    private function getParcel(Collection $items): array
    {
        $length = 0;
        $width = 0;
        $height = 0;
        $weight = 0;

        /** @var OrderItemInterface $item */
        foreach ($items as $item) {
            $length += $item->getVariant()->getDepth();
            $width += $item->getVariant()->getWidth();
            $height += $item->getVariant()->getHeight();
            $weight += $item->getVariant()->getWeight();
        }

        return [
            'length' => $length,
            'width' => $width,
            'height' => $height,
            'weight' => $weight,
        ];
    }

    private function getToAddress(AddressInterface $shippingAddress): array
    {
        $provinceCode = str_replace('CA-', '', (string) $shippingAddress->getProvinceCode());

        return [
            'name' => $shippingAddress->getFullName(),
            'street1' => $shippingAddress->getStreet(),
            'city' => $shippingAddress->getCity(),
            'country' => $shippingAddress->getCountryCode(),
            'state' => $provinceCode,
            'zip' => $shippingAddress->getPostcode(),
            'phone' => $shippingAddress->getPhoneNumber(),
        ];
    }

    private function getFromAddress(): array
    {
        $configuration = $this->enabledEasyPostConfigurationProvider->getConfiguration();

        $senderData = $configuration->getSenderData();

        return [
            'name' => $senderData->getFullName(),
            'company' => $senderData->getCompany(),
            'street1' => $senderData->getStreet(),
            'city' => $senderData->getCity(),
            'country' => $senderData->getCountryCode(),
            'state' => $senderData->getProvinceName(),
            'zip' => $senderData->getPostcode(),
            'phone' => $senderData->getPhoneNumber(),
        ];
    }

    private function getShipment($id): Shipment
    {
        return Shipment::retrieve($id);
    }
}
