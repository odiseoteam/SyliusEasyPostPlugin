<?php

declare(strict_types=1);

namespace Odiseo\SyliusEasyPostPlugin\Entity;

trait EasyPostTrait
{
    protected ?string $rates = null;

    protected ?string $postageLabelUrl = null;

    protected ?string $trackingUrl = null;

    public function getRates(): ?string
    {
        return $this->rates;
    }

    public function setRates(?string $rates): void
    {
        $this->rates = $rates;
    }

    public function getPostageLabelUrl(): ?string
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
    }
}
