<?php

declare(strict_types=1);

namespace Odiseo\SyliusEasyPostPlugin\Entity;

interface ShipmentAwareInterface
{
    /**
     * @param string $easyPostRates
     */
    public function setEasyPostRates(string $easyPostRates): void;

    /**
     * @return string
     */
    public function getPostageLabelUrl(): string;

    /**
     * @param string $postageLabelUrl
     */
    public function setPostageLabelUrl(string $postageLabelUrl): void;

    /**
     * @return string
     */
    public function getTrackingUrl(): string;

    /**
     * @param string $trackingUrl
     */
    public function setTrackingUrl(string $trackingUrl): void;

}
