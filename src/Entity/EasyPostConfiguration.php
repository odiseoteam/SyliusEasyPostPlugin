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

    protected ?string $name = null;

    protected ?string $apiKey = null;

    protected ?EasyPostConfigurationSenderDataInterface $senderData = null;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getId(): ?int
    {
        return $this->id;
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
