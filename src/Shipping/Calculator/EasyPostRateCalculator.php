<?php

declare(strict_types=1);

namespace Odiseo\SyliusEasyPostPlugin\Shipping\Calculator;

use EasyPost\Error;
use EasyPost\Rate;
use Odiseo\SyliusEasyPostPlugin\Api\EasyPostClient;
use Sylius\Component\Core\Exception\MissingChannelConfigurationException;
use Sylius\Component\Shipping\Calculator\CalculatorInterface;
use Sylius\Component\Shipping\Model\ShipmentInterface;

final class EasyPostRateCalculator implements CalculatorInterface
{
    public function __construct(
        private EasyPostClient $easyPostClient
    ) {
    }

    public function calculate(ShipmentInterface $subject, array $configuration): int
    {
        $order = $subject->getOrder();
        $channel = $order->getChannel();

        $channelCode = $channel->getCode();

        if (!isset($configuration[$channelCode])) {
            throw new MissingChannelConfigurationException(sprintf(
                'Channel %s has no configuration defined for shipping method %s',
                $channel->getName(),
                $subject->getMethod()->getName(),
            ));
        }

        try {
            $rates = $this->easyPostClient->getRates($order);
        } catch (Error $exception) {
            $rates = [];
        }

        /** @var Rate $rate */
        foreach ($rates as $rate) {
            if ($rate->carrier === $configuration[$channelCode]['carrier'] && $rate->service === $configuration[$channelCode]['service']) {
                return (int) ($rate->rate * 100);
            }
        }

        return (int) $configuration[$channelCode]['default_amount'];
    }

    public function getType(): string
    {
        return 'easy_post_rate';
    }
}
