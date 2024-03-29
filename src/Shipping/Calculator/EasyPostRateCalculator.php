<?php

declare(strict_types=1);

namespace Odiseo\SyliusEasyPostPlugin\Shipping\Calculator;

use EasyPost\Error;
use Odiseo\SyliusEasyPostPlugin\Api\EasyPostClient;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Core\Model\ShipmentInterface;
use Sylius\Component\Shipping\Calculator\CalculatorInterface;
use Sylius\Component\Shipping\Model\ShipmentInterface as BaseShipmentInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Webmozart\Assert\Assert;

final class EasyPostRateCalculator implements CalculatorInterface
{
    public function __construct(
        private EasyPostClient $easyPostClient
    ) {
    }

    public function calculate(BaseShipmentInterface $subject, array $configuration): int
    {
        Assert::isInstanceOf($subject, ShipmentInterface::class);

        if (!isset($configuration['carrier'])) {
            throw new NotFoundHttpException(sprintf(
                'Carrier not defined for shipping method %s',
                $subject->getMethod()->getName(),
            ));
        }
        if (!isset($configuration['service'])) {
            throw new NotFoundHttpException(sprintf(
                'Service not defined for shipping method %s',
                $subject->getMethod()->getName(),
            ));
        }

        /** @var OrderInterface $order */
        $order = $subject->getOrder();

        try {
            $rate = $this->easyPostClient->getRate($order, $configuration['carrier'], $configuration['service']);

            return (int) ((float) ($rate->rate) * 100);
        } catch (Error $e) {
            //dump($e);die;
            throw $e;
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function getType(): string
    {
        return 'easy_post_rate';
    }
}
