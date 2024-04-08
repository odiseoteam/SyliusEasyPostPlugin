<?php

declare(strict_types=1);

namespace Tests\Odiseo\SyliusEasyPostPlugin\Behat\Context\Setup;

use Behat\Behat\Context\Context;
use Odiseo\SyliusEasyPostPlugin\Entity\EasyPostConfigurationInterface;
use Odiseo\SyliusEasyPostPlugin\Repository\EasyPostConfigurationRepositoryInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

final class EasyPostConfigurationContext implements Context
{
    public function __construct(
        private FactoryInterface $easyPostConfigurationFactory,
        private EasyPostConfigurationRepositoryInterface $easyPostConfigurationRepository,
    ) {
    }

    /**
     * @Given there is an existing Easy Post configuration with :code code
     */
    public function thereIsAConfigurationWithCode(string $code): void
    {
        $configuration = $this->createConfiguration($code);

        $this->saveConfiguration($configuration);
    }

    private function createConfiguration(string $code): EasyPostConfigurationInterface
    {
        /** @var EasyPostConfigurationInterface $configuration */
        $configuration = $this->easyPostConfigurationFactory->createNew();

        $configuration->setCode($code);
        $configuration->setEnabled(true);
        $configuration->setApiKey('123456');

        return $configuration;
    }

    private function saveConfiguration(EasyPostConfigurationInterface $configuration): void
    {
        $this->easyPostConfigurationRepository->add($configuration);
    }
}
