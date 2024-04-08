<?php

declare(strict_types=1);

namespace Tests\Odiseo\SyliusEasyPostPlugin\Behat\Page\Admin\EasyPostConfiguration;

use Sylius\Behat\Page\Admin\Crud\IndexPage as BaseIndexPage;

final class IndexPage extends BaseIndexPage implements IndexPageInterface
{
    public function deleteConfiguration(string $code): void
    {
        $this->deleteResourceOnPage(['code' => $code]);
    }
}
