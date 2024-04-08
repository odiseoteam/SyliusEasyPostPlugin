<?php

declare(strict_types=1);

namespace Odiseo\SyliusEasyPostPlugin\Form\Type;

use Sylius\Bundle\AddressingBundle\Form\Type\CountryCodeChoiceType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class EasyPostConfigurationSenderDataType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('firstName', TextType::class, [
                'label' => 'odiseo_sylius_easy_post_plugin.form.easy_post_configuration_sender_data.first_name',
                'required' => false,
            ])
            ->add('lastName', TextType::class, [
                'label' => 'odiseo_sylius_easy_post_plugin.form.easy_post_configuration_sender_data.last_name',
                'required' => false,
            ])
            ->add('phoneNumber', TextType::class, [
                'label' => 'odiseo_sylius_easy_post_plugin.form.easy_post_configuration_sender_data.phone_number',
                'required' => false,
            ])
            ->add('company', TextType::class, [
                'label' => 'odiseo_sylius_easy_post_plugin.form.easy_post_configuration_sender_data.company',
                'required' => false,
            ])
            ->add('countryCode', CountryCodeChoiceType::class, [
                'label' => 'odiseo_sylius_easy_post_plugin.form.easy_post_configuration_sender_data.country',
                'enabled' => true,
            ])
            ->add('street', TextType::class, [
                'label' => 'odiseo_sylius_easy_post_plugin.form.easy_post_configuration_sender_data.street',
                'required' => false,
            ])
            ->add('city', TextType::class, [
                'label' => 'odiseo_sylius_easy_post_plugin.form.easy_post_configuration_sender_data.city',
                'required' => false,
            ])
            ->add('postcode', TextType::class, [
                'label' => 'odiseo_sylius_easy_post_plugin.form.easy_post_configuration_sender_data.postcode',
                'required' => false,
            ])
            ->add('provinceCode', TextType::class, [
                'label' => 'odiseo_sylius_easy_post_plugin.form.easy_post_configuration_sender_data.province_code',
                'required' => false,
            ])
            ->add('provinceName', TextType::class, [
                'label' => 'odiseo_sylius_easy_post_plugin.form.easy_post_configuration_sender_data.province_name',
                'required' => false,
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'odiseo_easy_post_configuration_sender_data';
    }
}
