<?php

declare(strict_types=1);

namespace Odiseo\SyliusEasyPostPlugin\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class EasyPostConfigurationType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('name', TextType::class, [
                'label' => 'sylius.ui.name',
            ])
            ->add('apiKey', TextType::class, [
                'label' => 'odiseo_sylius_easy_post_plugin.form.easy_post_configuration.api_key',
            ])
            ->add('enabled', CheckboxType::class, [
                'label' => 'sylius.ui.enabled',
            ])
            ->add('senderData', EasyPostConfigurationSenderDataType::class, [
                'label' => 'odiseo_sylius_easy_post_plugin.form.easy_post_configuration.sender_data',
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'odiseo_easy_post_configuration';
    }
}
