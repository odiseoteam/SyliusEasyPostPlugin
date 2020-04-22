<?php

namespace Odiseo\SyliusEasyPostPlugin\Entity;

class EasyPostConfiguration implements EasyPostConfigurationInterface
{
    /** @var string */
    private $id;

    /** @var string */
    private $apiKey;

    /** @var string */
    private $street1;

    /** @var string */
    private $street2;

    /** @var string */
    private $city;

    /** @var string */
    private $country;

    /** @var string */
    private $state;

    /** @var string */
    private $zip;

    /** @var string */
    private $phone;

    /** @var bool */
    private $enabled;

    public function getId()
    {
        return $this->id;
    }

    public function setApiKey(string $apiKey): void
    {
        $this->apiKey = $apiKey;
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function setStreet1(string $street1): void
    {
        $this->street1 = $street1;
    }

    public function getStreet1(): string
    {
        return $this->street1;
    }

    public function setStreet2(string $street2): void
    {
        $this->street2 = $street2;
    }

    public function getStreet2(): string
    {
        return $this->street2;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setState(string $state): void
    {
        $this->state = $state;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setZip(string $zip): void
    {
        $this->zip = $zip;
    }

    public function getZip(): string
    {
        return $this->zip;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function enable(): void
    {
        $this->enabled = true;
    }

    public function disable(): void
    {
        $this->enabled = false;
    }
}
