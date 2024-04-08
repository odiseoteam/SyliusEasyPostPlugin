<?php

declare(strict_types=1);

namespace Tests\Odiseo\SyliusEasyPostPlugin\Behat\Context\Ui\Admin;

use Behat\Behat\Context\Context;
use FriendsOfBehat\PageObjectExtension\Page\SymfonyPageInterface;
use Odiseo\SyliusEasyPostPlugin\Entity\EasyPostConfigurationInterface;
use Sylius\Behat\Service\Resolver\CurrentPageResolverInterface;
use Tests\Odiseo\SyliusEasyPostPlugin\Behat\Page\Admin\EasyPostConfiguration\CreatePageInterface;
use Tests\Odiseo\SyliusEasyPostPlugin\Behat\Page\Admin\EasyPostConfiguration\IndexPageInterface;
use Webmozart\Assert\Assert;

final class ManagingEasyPostConfigurationsContext implements Context
{
    public function __construct(
        private CurrentPageResolverInterface $currentPageResolver,
        private IndexPageInterface $indexPage,
        private CreatePageInterface $createPage
    ) {
    }

    /**
     * @Given I want to add a new Easy Post configuration
     */
    public function iWantToAddNewConfiguration(): void
    {
        $this->createPage->open();
    }

    /**
     * @When I fill the code with :code
     * @When I rename the code with :code
     */
    public function iFillTheCodeWith(string $code): void
    {
        $this->createPage->fillCode($code);
    }

    /**
     * @When I fill the api key with :apiKey
     * @When I rename the api key with :apiKey
     */
    public function iFillTheApiKeyWith(string $apiKey): void
    {
        $this->createPage->fillApiKey($apiKey);
    }

    /**
     * @When I add it
     */
    public function iAddIt(): void
    {
        $this->createPage->create();
    }

    /**
     * @Then /^the (Easy Post configuration "([^"]+)") should appear in the admin/
     */
    public function configurationShouldAppearInTheAdmin(EasyPostConfigurationInterface $configuration): void
    {
        $this->indexPage->open();

        Assert::true(
            $this->indexPage->isSingleResourceOnPage(['code' => $configuration->getCode()]),
            sprintf('Easy Post configuration %s should exist but it does not', $configuration->getCode())
        );
    }

    /**
     * @Then I should be notified that the form contains invalid fields
     */
    public function iShouldBeNotifiedThatTheFormContainsInvalidFields(): void
    {
        Assert::true(
            $this->resolveCurrentPage()->containsError(),
            'The form should be notified you that the form contains invalid field but it does not'
        );
    }

    /**
     * @Then I should be notified that there is already an existing Easy Post configuration with provided code
     */
    public function iShouldBeNotifiedThatThereIsAlreadyAnExistingConfigurationWithSlug(): void
    {
        Assert::true(
            $this->resolveCurrentPage()->containsErrorWithMessage(
                'There is an existing configuration with this code.',
                false
            )
        );
    }

    private function resolveCurrentPage(): SymfonyPageInterface
    {
        return $this->currentPageResolver->getCurrentPageWithForm([
            $this->indexPage,
            $this->createPage
        ]);
    }
}
