<?php

declare(strict_types=1);

namespace Odiseo\SyliusEasyPostPlugin\Provider;

use Odiseo\SyliusEasyPostPlugin\Entity\EasyPostConfigurationInterface;

interface EnabledEasyPostConfigurationProviderInterface
{
    public function getConfiguration(): ?EasyPostConfigurationInterface;
}
