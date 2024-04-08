<?php

declare(strict_types=1);

namespace Odiseo\SyliusEasyPostPlugin\Generator;

use Odiseo\SyliusEasyPostPlugin\Api\EasyPostClient;
use Sylius\Component\Core\Model\ShipmentInterface;

final class ShipmentTrackingGenerator implements ShipmentTrackingGeneratorInterface
{
    public function __construct(
        private EasyPostClient $easyPostClient,
    ) {
    }

    public function generate(ShipmentInterface $shipment): void
    {
        $shipment->setTracking($this->easyPostClient->buyShipment($shipment)?->tracking_code);
    }
}
