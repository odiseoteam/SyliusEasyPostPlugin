<?php

namespace Odiseo\SyliusEasyPostPlugin\Entity;

use Sylius\Component\Resource\Model\ResourceInterface;

interface EasyPostConfigurationInterface extends ResourceInterface
{
    public function setApiKey(string $apiKey): void;

    public function getApiKey(): string;

    public function setStreet1(string $street1): void;

    public function getStreet1(): string;

    public function setStreet2(string $street2): void;

    public function getStreet2(): string;

    public function setCity(string $city): void;

    public function getCity(): string;

    public function setCountry(string $country): void;

    public function getCountry(): string;

    public function setState(string $state): void;

    public function getState(): string;

    public function setZip(string $zip): void;

    public function getZip(): string;

    public function setPhone(string $phone): void;

    public function getPhone(): string;

    public function enable(): void;

    public function disable(): void;

    public function isEnabled(): bool;
}
