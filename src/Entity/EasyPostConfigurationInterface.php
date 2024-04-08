<?php

declare(strict_types=1);

namespace Odiseo\SyliusEasyPostPlugin\Entity;

use Sylius\Component\Resource\Model\CodeAwareInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;
use Sylius\Component\Resource\Model\ToggleableInterface;

interface EasyPostConfigurationInterface extends
    CodeAwareInterface,
    ResourceInterface,
    ToggleableInterface,
    TimestampableInterface
{
    public function getApiKey(): ?string;

    public function setApiKey(?string $apiKey): void;

    public function getSenderData(): ?EasyPostConfigurationSenderDataInterface;

    public function setSenderData(?EasyPostConfigurationSenderDataInterface $senderData): void;
}
