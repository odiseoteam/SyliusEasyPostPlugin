<?php

declare(strict_types=1);

namespace Odiseo\SyliusEasyPostPlugin\Entity;

interface EasyPostAwareInterface
{
    public function getShipmentId(): ?string;

    public function setShipmentId(?string $shipmentId): void;

    public function getRateId(): ?string;

    public function setRateId(?string $rateId): void;

    /*public function getPostageLabelUrl(): ?string;

    public function setPostageLabelUrl(?string $postageLabelUrl): void;

    public function getTrackingUrl(): ?string;

    public function setTrackingUrl(?string $trackingUrl): void;*/
}
