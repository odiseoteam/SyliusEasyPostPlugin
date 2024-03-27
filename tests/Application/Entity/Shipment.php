<?php

namespace Tests\Odiseo\SyliusEasyPostPlugin\Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Odiseo\SyliusEasyPostPlugin\Entity\EasyPostAwareInterface;
use Odiseo\SyliusEasyPostPlugin\Entity\EasyPostTrait;
use Sylius\Component\Core\Model\Shipment as BaseShipment;

/**
 * @ORM\Table(name="sylius_shipment")
 * @ORM\Entity
 */
class Shipment extends BaseShipment implements EasyPostAwareInterface
{
    use EasyPostTrait;
}
