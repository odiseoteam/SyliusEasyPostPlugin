<?php

declare(strict_types=1);

namespace Odiseo\SyliusEasyPostPlugin\Assigner;

use EasyPost\Rate;
use Odiseo\SyliusEasyPostPlugin\Api\EasyPostClient;
use Odiseo\SyliusEasyPostPlugin\Entity\EasyPostAwareInterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Core\Model\ShipmentInterface;

final class ShipmentRateAssigner implements ShipmentRateAssignerInterface
{
    public function __construct(
        private EasyPostClient $easyPostClient,
    ) {
    }

    public function assignRate(ShipmentInterface $shipment): void
    {
        if (!$shipment instanceof EasyPostAwareInterface) {
            return;
        }

        /** @var OrderInterface $order */
        $order = $shipment->getOrder();
        /** @var ChannelInterface $channel */
        $channel = $order->getChannel();

        $channelCode = $channel->getCode();

        $configuration = $shipment->getMethod()?->getConfiguration();

        if (!isset($configuration[$channelCode])) {
            return;
        }

        $rates = $this->easyPostClient->getRates($shipment);

        /** @var Rate $rate */
        foreach ($rates as $rate) {
            if (
                $rate->carrier === $configuration[$channelCode]['carrier'] &&
                $rate->service === $configuration[$channelCode]['service']
            ) {
                $shipment->setRateId($rate->id);

                break;
            }
        }
    }
}
