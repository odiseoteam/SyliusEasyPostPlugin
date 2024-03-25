<?php

namespace Tests\Odiseo\SyliusEasyPostPlugin\Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Odiseo\SyliusEasyPostPlugin\Entity\ShipmentAwareInterface;
use Odiseo\SyliusEasyPostPlugin\Entity\ShipmentTrait;
use Sylius\Component\Core\Model\Shipment as BaseShipment;

/**
 * @ORM\Table(name="sylius_shipment")
 * @ORM\Entity
 */
class Shipment extends BaseShipment implements ShipmentAwareInterface
{
    use ShipmentTrait;
}
