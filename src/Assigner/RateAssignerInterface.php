<?php

declare(strict_types=1);

namespace Odiseo\SyliusEasyPostPlugin\Assigner;

use Sylius\Component\Core\Model\ShipmentInterface;

interface RateAssignerInterface
{
    public function assignRate(ShipmentInterface $shipment): void;
}
