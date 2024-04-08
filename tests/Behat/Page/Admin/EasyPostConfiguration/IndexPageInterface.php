<?php

declare(strict_types=1);

namespace Tests\Odiseo\SyliusEasyPostPlugin\Behat\Page\Admin\EasyPostConfiguration;

use Sylius\Behat\Page\Admin\Crud\IndexPageInterface as BaseIndexPageInterface;

interface IndexPageInterface extends BaseIndexPageInterface
{
    public function deleteConfiguration(string $code): void;
}
