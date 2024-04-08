<?php

declare(strict_types=1);

namespace Tests\Odiseo\SyliusEasyPostPlugin\Behat\Page\Admin\EasyPostConfiguration;

use Sylius\Behat\Page\Admin\Crud\CreatePageInterface as BaseCreatePageInterface;
use Tests\Odiseo\SyliusEasyPostPlugin\Behat\Behaviour\ContainsErrorInterface;

interface CreatePageInterface extends BaseCreatePageInterface, ContainsErrorInterface
{
    public function fillCode(string $code): void;

    public function fillApiKey(string $apiKey): void;
}
