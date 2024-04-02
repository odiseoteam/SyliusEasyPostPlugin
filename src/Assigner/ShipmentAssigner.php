<?php

declare(strict_types=1);

namespace Odiseo\SyliusEasyPostPlugin\Assigner;

use Odiseo\SyliusEasyPostPlugin\Api\EasyPostClient;
use Odiseo\SyliusEasyPostPlugin\Entity\EasyPostAwareInterface;
use Sylius\Component\Core\Model\OrderInterface;

final class ShipmentAssigner implements ShipmentAssignerInterface
{
    public function __construct(
        private EasyPostClient $easyPostClient,
    ) {
    }

    public function assignShipment(OrderInterface $order): void
    {
        foreach ($order->getShipments() as $subject) {
            if (!$subject instanceof EasyPostAwareInterface) {
                continue;
            }

            $shipment = $this->easyPostClient->createShipment($order);
            if (null !== $shipment) {
                $subject->setShipmentId($shipment->id);
            }
        }
    }
}
