<?php

declare(strict_types=1);

namespace Odiseo\SyliusEasyPostPlugin\Assigner;

use Sylius\Component\Core\Model\OrderInterface;

interface ShipmentAssignerInterface
{
    public function assignShipment(OrderInterface $order): void;
}
