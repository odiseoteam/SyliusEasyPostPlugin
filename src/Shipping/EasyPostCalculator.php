<?php

namespace Odiseo\SyliusEasyPostPlugin\Shipping;

use EasyPost\Error;
use Odiseo\SyliusEasyPostPlugin\Service\EasyPostService;
use Sylius\Component\Shipping\Calculator\CalculatorInterface;
use Sylius\Component\Shipping\Model\ShipmentInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class EasyPostCalculator implements CalculatorInterface
{
    private $easyPostService;

    private $requestStack;

    public function __construct(EasyPostService $easyPostService, RequestStack $requestStack)
    {
        $this->easyPostService = $easyPostService;
        $this->requestStack = $requestStack;
    }

    public function calculate(ShipmentInterface $subject, array $configuration): int
    {
        try {
            $carrier = $configuration['carrier'];
            $service = isset($configuration['service']) ? $configuration['service'] : null;

            $shippingAddress = $subject->getOrder()->getShippingAddress();
            $items = $subject->getOrder()->getItems();

            $rate = $this->easyPostService->getRate($shippingAddress, $configuration, $items, $carrier, $service);

            $ratePrice = (int) ($rate->rate * 100);

            return $ratePrice;
        } catch (Error $e) {
            //dump($e);die;
            throw $e;
        }
    }

    public function getType(): string
    {
        return 'easy_post';
    }
}
