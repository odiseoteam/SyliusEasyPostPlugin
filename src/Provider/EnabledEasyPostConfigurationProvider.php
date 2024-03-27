<?php

declare(strict_types=1);

namespace Odiseo\SyliusEasyPostPlugin\Provider;

use Odiseo\SyliusEasyPostPlugin\Entity\EasyPostConfigurationInterface;
use Odiseo\SyliusEasyPostPlugin\Repository\EasyPostConfigurationRepositoryInterface;

final class EnabledEasyPostConfigurationProvider implements EnabledEasyPostConfigurationProviderInterface
{
    public function __construct(
        private EasyPostConfigurationRepositoryInterface $easyPostConfigurationRepository,
    ) {
    }

    public function getConfiguration(): ?EasyPostConfigurationInterface
    {
        return $this->easyPostConfigurationRepository->findOneByEnabled();
    }
}
