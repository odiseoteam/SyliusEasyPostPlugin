<?php

namespace Odiseo\SyliusEasyPostPlugin\Service;

use EasyPost\EasyPost;
use EasyPost\Rate;
use EasyPost\Shipment;
use Sylius\Component\Core\Model\AddressInterface;
use Sylius\Component\Core\Model\OrderItemInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class EasyPostService
{
    /** @var Shipment */
    private $shipment;

    /** @var Session */
    protected $session;

    /**
     * EasyPostService constructor.
     *
     * @param string $apiKey
     * @param Session $session
     */
    public function __construct($apiKey, Session $session)
    {
        EasyPost::setApiKey($apiKey);

        $this->session = $session;
    }

    public function buyShipment(Rate $rate)
    {
        $shipmentId = $rate->shipment_id;
        $shipment = $this->getShipment($shipmentId);

        if (null === $shipment->selected_rate) {
            $shipment->buy($rate);
        }

        return $shipment;
    }

    public function getSelectedRate($id)
    {
        $rate = Rate::retrieve($id);

        return $rate;
    }

    public function getRate(AddressInterface $shippingAddress, array $configuration, $items, $carrier, $service = null)
    {
        $this->shipment = $this->getOrCreateShipment($shippingAddress, $configuration, $items);

        if ($service) {
            foreach ($this->shipment->rates as $rate) {
                if ($rate->carrier == $carrier && $rate->service == $service) {
                    return $rate;
                }
            }
        }

        throw new \Exception('No rate found');
    }

    public function getOrCreateShipment(AddressInterface $shippingAddress, array $configuration, $items)
    {
        if (!$this->shipment) {
            $this->shipment = $this->createShipment($shippingAddress, $configuration, $items);
            $this->saveRatesToSession($this->shipment);
        }

        return $this->shipment;
    }

    protected function createShipment(AddressInterface $shippingAddress, array $configuration, $items)
    {
        return Shipment::create([
            'from_address' => $this->getFromAddress($configuration),
            'to_address' => $this->getToAddress($shippingAddress),
            'parcel' => $this->getParcel($items),
        ]);
    }

    protected function getParcel($items)
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

    protected function getToAddress(AddressInterface $shippingAddress)
    {
        $provinceCode = str_replace('CA-', '', $shippingAddress->getProvinceCode());

        return [
            'name' => $shippingAddress->getFirstName().' '.$shippingAddress->getLastName(),
            'street1' => $shippingAddress->getStreet(),
            'city' => $shippingAddress->getCity(),
            'country' => $shippingAddress->getCountryCode(),
            'state' => $provinceCode,
            'zip' => $shippingAddress->getPostCode(),
            'phone' => $shippingAddress->getPhoneNumber(),
        ];
    }

    protected function getFromAddress(array $configuration)
    {
        return [
            'company' => $configuration['company'],
            'street1' => $configuration['street1'],
            'street2' => $configuration['street2'],
            'city' => $configuration['city'],
            'country' => 'CA',
            'state' => $configuration['state'],
            'zip' => $configuration['zip'],
            'phone' => $configuration['phone'],
        ];
    }

    protected function getShipment($id)
    {
        $shipment = Shipment::retrieve($id);

        return $shipment;
    }

    protected function saveRatesToSession(Shipment $shipment)
    {
        $sessionRates = [];

        foreach ($shipment->rates as $rate) {
            $sessionRates[$rate->carrier.'_'.$rate->service] = [
                'rateId' => $rate->id,
            ];
        }

        $sessionRates = json_encode($sessionRates);

        $this->session->set('sessionRates', $sessionRates);
    }
}
