<?php

declare(strict_types=1);

namespace Tests\Odiseo\SyliusEasyPostPlugin\Behat\Page\Admin\EasyPostConfiguration;

use Sylius\Behat\Page\Admin\Crud\CreatePage as BaseCreatePage;
use Tests\Odiseo\SyliusEasyPostPlugin\Behat\Behaviour\ContainsErrorTrait;

final class CreatePage extends BaseCreatePage implements CreatePageInterface
{
    use ContainsErrorTrait;

    public function fillCode(string $code): void
    {
        $this->getDocument()->fillField('Code', $code);
    }

    public function fillApiKey(string $apiKey): void
    {
        $this->getDocument()->fillField('Api key', $apiKey);
    }
}
