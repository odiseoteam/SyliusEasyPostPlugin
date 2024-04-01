<?php

declare(strict_types=1);

namespace Odiseo\SyliusEasyPostPlugin\Fixture\Factory;

use Faker\Factory;
use Faker\Generator as FakerGenerator;
use Odiseo\SyliusEasyPostPlugin\Entity\EasyPostConfigurationInterface;
use Odiseo\SyliusEasyPostPlugin\Entity\EasyPostConfigurationSenderData;
use Sylius\Bundle\CoreBundle\Fixture\Factory\ExampleFactoryInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EasyPostConfigurationExampleFactory implements ExampleFactoryInterface
{
    protected FakerGenerator $faker;
    protected OptionsResolver $optionsResolver;

    public function __construct(
        protected FactoryInterface $easyPostConfigurationFactory
    ) {
        $this->faker = Factory::create();
        $this->optionsResolver = new OptionsResolver();

        $this->configureOptions($this->optionsResolver);
    }

    public function create(array $options = []): EasyPostConfigurationInterface
    {
        $options = $this->optionsResolver->resolve($options);

        /** @var EasyPostConfigurationInterface $easyPostConfiguration */
        $easyPostConfiguration = $this->easyPostConfigurationFactory->createNew();

        $easyPostConfiguration->setCode($options['code']);
        $easyPostConfiguration->setApiKey($options['api_key']);
        $easyPostConfiguration->setEnabled($options['enabled']);

        if (count($options['sender_data']) > 0) {
            $senderData = new EasyPostConfigurationSenderData();

            $senderData->setFirstName($options['sender_data']['first_name'] ?? null);
            $senderData->setLastName($options['sender_data']['last_name'] ?? null);
            $senderData->setCompany($options['sender_data']['company'] ?? null);
            $senderData->setStreet($options['sender_data']['street'] ?? null);
            $senderData->setCountryCode($options['sender_data']['country_code'] ?? null);
            $senderData->setProvinceCode($options['sender_data']['province_code'] ?? null);
            $senderData->setProvinceName($options['sender_data']['province_name'] ?? null);
            $senderData->setCity($options['sender_data']['city'] ?? null);
            $senderData->setPostcode($options['sender_data']['postcode'] ?? null);
            $senderData->setPhoneNumber($options['sender_data']['phone_number'] ?? null);

            $easyPostConfiguration->setSenderData($senderData);
        }

        return $easyPostConfiguration;
    }

    protected function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setRequired('code')
            ->setRequired('api_key')
            ->setDefault('sender_data', [])
            ->setDefault('enabled', false)
            ->setAllowedTypes('enabled', 'bool')
        ;
    }
}
