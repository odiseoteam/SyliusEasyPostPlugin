<?php

namespace Tests\Odiseo\SyliusEasyPostPlugin\Application\Entity;

use Odiseo\SyliusEasyPostPlugin\Entity\ShipmentAwareInterface;
use Odiseo\SyliusEasyPostPlugin\Entity\ShipmentTrait;
use Sylius\Component\Core\Model\Shipment as BaseShipment;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Table(name="sylius_shipment")
 * @ORM\Entity
 */
class Shipment extends BaseShipment implements ShipmentAwareInterface
{
    use ShipmentTrait;
}
