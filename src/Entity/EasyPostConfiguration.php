<?php

declare(strict_types=1);

namespace Odiseo\SyliusEasyPostPlugin\Entity;

use Sylius\Component\Resource\Model\TimestampableTrait;
use Sylius\Component\Resource\Model\ToggleableTrait;

class EasyPostConfiguration implements EasyPostConfigurationInterface
{
    use TimestampableTrait;
    use ToggleableTrait;

    protected ?int $id = null;

    protected ?string $code = null;

    protected ?string $apiKey = null;

    protected ?EasyPostConfigurationSenderDataInterface $senderData = null;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    public function getApiKey(): ?string
    {
        return $this->apiKey;
    }

    public function setApiKey(?string $apiKey): void
    {
        $this->apiKey = $apiKey;
    }

    public function getSenderData(): ?EasyPostConfigurationSenderDataInterface
    {
        return $this->senderData;
    }

    public function setSenderData(?EasyPostConfigurationSenderDataInterface $senderData): void
    {
        $this->senderData = $senderData;
    }
}
