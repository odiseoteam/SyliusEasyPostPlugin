<?php

declare(strict_types=1);

namespace Odiseo\SyliusEasyPostPlugin\Shipping\Checker\Eligibility;

use EasyPost\Error;
use EasyPost\Rate;
use Odiseo\SyliusEasyPostPlugin\Api\EasyPostClient;
use Sylius\Component\Shipping\Checker\Eligibility\ShippingMethodEligibilityCheckerInterface;
use Sylius\Component\Shipping\Model\ShippingMethodInterface;
use Sylius\Component\Shipping\Model\ShippingSubjectInterface;

final class EasyPostEligibilityChecker implements ShippingMethodEligibilityCheckerInterface
{
    public function __construct(
        private EasyPostClient $easyPostClient
    ) {
    }

    public function isEligible(ShippingSubjectInterface $shippingSubject, ShippingMethodInterface $shippingMethod): bool
    {
        if ($shippingMethod->getCalculator() !== 'easy_post_rate') {
            return false;
        }

        $order = $shippingSubject->getOrder();
        $channel = $order->getChannel();

        $channelCode = $channel->getCode();

        try {
            $rates = $this->easyPostClient->getRates($order);
        } catch (Error $exception) {
            $rates = [];
        }

        if (count($rates) <= 0) {
            return false;
        }

        $rateCarriers = [];
        $rateServices = [];

        /** @var Rate $rate */
        foreach ($rates as $rate) {
            $rateCarriers[] = $rate->carrier;
            $rateServices[] = $rate->service;
        }

        $carrier = $shippingMethod->getConfiguration()[$channelCode]['carrier'] ?? null;
        $service = $shippingMethod->getConfiguration()[$channelCode]['service'] ?? null;
        if (!in_array($carrier, $rateCarriers, true) || !in_array($service, $rateServices, true)) {
            return false;
        }

        return true;
    }
}
