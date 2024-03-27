<?php

declare(strict_types=1);

namespace Odiseo\SyliusEasyPostPlugin\Entity;

interface EasyPostAwareInterface
{
    public function getRates(): ?string;

    public function setRates(?string $rates): void;

    public function getPostageLabelUrl(): ?string;

    public function setPostageLabelUrl(?string $postageLabelUrl): void;

    public function getTrackingUrl(): ?string;

    public function setTrackingUrl(?string $trackingUrl): void;
}
