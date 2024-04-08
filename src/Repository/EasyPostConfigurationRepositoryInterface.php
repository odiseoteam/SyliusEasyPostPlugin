<?php

declare(strict_types=1);

namespace Odiseo\SyliusEasyPostPlugin\Repository;

use Odiseo\SyliusEasyPostPlugin\Entity\EasyPostConfigurationInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

interface EasyPostConfigurationRepositoryInterface extends RepositoryInterface
{
    public function findOneByEnabled(): ?EasyPostConfigurationInterface;
}
