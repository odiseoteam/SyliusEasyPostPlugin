<?php

declare(strict_types=1);

namespace Odiseo\SyliusEasyPostPlugin\Generator;

use Sylius\Component\Core\Model\ShipmentInterface;

interface ShipmentTrackingGeneratorInterface
{
    public function generate(ShipmentInterface $shipment): void;
}
