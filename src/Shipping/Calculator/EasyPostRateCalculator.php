<?php

declare(strict_types=1);

namespace Odiseo\SyliusEasyPostPlugin\Shipping\Calculator;

use EasyPost\Rate;
use Odiseo\SyliusEasyPostPlugin\Api\EasyPostClient;
use Sylius\Component\Core\Exception\MissingChannelConfigurationException;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Core\Model\ShipmentInterface;
use Sylius\Component\Shipping\Calculator\CalculatorInterface;
use Sylius\Component\Shipping\Model\ShipmentInterface as BaseShipmentInterface;

final class EasyPostRateCalculator implements CalculatorInterface
{
    public function __construct(
        private EasyPostClient $easyPostClient,
    ) {
    }

    public function calculate(BaseShipmentInterface $subject, array $configuration): int
    {
        /** @var ShipmentInterface $shipment */
        $shipment = $subject;

        /** @var OrderInterface $order */
        $order = $shipment->getOrder();
        /** @var ChannelInterface $channel */
        $channel = $order->getChannel();

        $channelCode = $channel->getCode();

        if (!isset($configuration[$channelCode])) {
            throw new MissingChannelConfigurationException(sprintf(
                'Channel %s has no configuration defined for shipping method %s',
                $channel->getName(),
                $shipment->getMethod()?->getName(),
            ));
        }

        $rates = $this->easyPostClient->getRates($shipment);

        /** @var Rate $rate */
        foreach ($rates as $rate) {
            if (
                $rate->carrier === $configuration[$channelCode]['carrier'] &&
                $rate->service === $configuration[$channelCode]['service']
            ) {
                return (int) ((float) $rate->rate * 100);
            }
        }

        return (int) $configuration[$channelCode]['default_amount'];
    }

    public function getType(): string
    {
        return 'easy_post_rate';
    }
}
