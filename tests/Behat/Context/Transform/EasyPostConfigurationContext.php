<?php

declare(strict_types=1);

namespace Tests\Odiseo\SyliusEasyPostPlugin\Behat\Context\Transform;

use Behat\Behat\Context\Context;
use Odiseo\SyliusEasyPostPlugin\Entity\EasyPostConfigurationInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Webmozart\Assert\Assert;

final class EasyPostConfigurationContext implements Context
{
    public function __construct(
        private RepositoryInterface $easyPostConfigurationRepository
    ) {
    }

    /**
     * @Transform /^Easy Post configuration "([^"]+)"$/
     * @Transform /^"([^"]+)" Easy Post configuration/
     */
    public function getConfigurationByName(string $code): EasyPostConfigurationInterface
    {
        /** @var EasyPostConfigurationInterface|null $configuration */
        $configuration = $this->easyPostConfigurationRepository->findOneBy(['code' => $code]);

        Assert::notNull(
            $configuration,
            'Easy Post configuration with code %s does not exist'
        );

        return $configuration;
    }
}
