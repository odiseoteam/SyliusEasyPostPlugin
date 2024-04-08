<?php

declare(strict_types=1);

namespace Odiseo\SyliusEasyPostPlugin\Entity;

trait EasyPostTrait
{
    protected ?string $shipmentId = null;

    protected ?string $rateId = null;

    //protected ?string $postageLabelUrl = null;

    //protected ?string $trackingUrl = null;

    public function getShipmentId(): ?string
    {
        return $this->shipmentId;
    }

    public function setShipmentId(?string $shipmentId): void
    {
        $this->shipmentId = $shipmentId;
    }

    public function getRateId(): ?string
    {
        return $this->rateId;
    }

    public function setRateId(?string $rateId): void
    {
        $this->rateId = $rateId;
    }

    /*public function getPostageLabelUrl(): ?string
    {
        return $this->postageLabelUrl;
    }

    public function setPostageLabelUrl(?string $postageLabelUrl): void
    {
        $this->postageLabelUrl = $postageLabelUrl;
    }

    public function getTrackingUrl(): ?string
    {
        return $this->trackingUrl;
    }

    public function setTrackingUrl(?string $trackingUrl): void
    {
        $this->trackingUrl = $trackingUrl;
    }*/
}
