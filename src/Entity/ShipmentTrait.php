<?php

namespace Odiseo\SyliusEasyPostPlugin\Entity;

trait ShipmentTrait
{
    /**
     * @var string
     */
    protected $easyPostRates;

    /**
     * @var string
     */
    protected $postageLabelUrl;

    /**
     * @var string
     */
    protected $trackingUrl;

    public function getEasyPostRates(): string
    {
        return $this->easyPostRates;
    }

    public function setEasyPostRates(string $easyPostRates): void
    {
        $this->easyPostRates = $easyPostRates;
    }

    public function getPostageLabelUrl(): string
    {
        return $this->postageLabelUrl;
    }

    public function setPostageLabelUrl(string $postageLabelUrl): void
    {
        $this->postageLabelUrl = $postageLabelUrl;
    }

    public function getTrackingUrl(): string
    {
        return $this->trackingUrl;
    }

    public function setTrackingUrl(string $trackingUrl): void
    {
        $this->trackingUrl = $trackingUrl;
    }
}
