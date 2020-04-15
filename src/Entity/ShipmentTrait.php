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

    /**
     * @return string
     */
    public function getEasyPostRates(): string
    {
        return $this->easyPostRates;
    }

    /**
     * @param string $easyPostRates
     */
    public function setEasyPostRates(string $easyPostRates):void
    {
        $this->easyPostRates = $easyPostRates;
    }

    /**
     * @return string
     */
    public function getPostageLabelUrl(): string
    {
        return $this->postageLabelUrl;
    }

    /**
     * @param string $postageLabelUrl
     */
    public function setPostageLabelUrl(string $postageLabelUrl): void
    {
        $this->postageLabelUrl = $postageLabelUrl;
    }

    /**
     * @return string
     */
    public function getTrackingUrl(): string
    {
        return $this->trackingUrl;
    }

    /**
     * @param string $trackingUrl
     */
    public function setTrackingUrl(string $trackingUrl):void
    {
        $this->trackingUrl = $trackingUrl;
    }
}
