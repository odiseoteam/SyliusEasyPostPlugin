<?php

declare(strict_types=1);

namespace Odiseo\SyliusEasyPostPlugin\Form\Type\Shipping\Calculator;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

final class EasyPostRateConfigurationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('carrier', TextType::class, [
                'label' => 'odiseo_sylius_easy_post_plugin.form.shipping_calculator.easy_post_rate_configuration.carrier',
                'constraints' => [
                    new NotBlank(['groups' => ['odiseo']]),
                ],
            ])
            ->add('service', TextType::class, [
                'label' => 'odiseo_sylius_easy_post_plugin.form.shipping_calculator.easy_post_rate_configuration.service',
                'constraints' => [
                    new NotBlank(['groups' => ['odiseo']]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'data_class' => null,
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return 'odiseo_shipping_calculator_easy_post_rate';
    }
}
