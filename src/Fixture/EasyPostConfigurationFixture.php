<?php

declare(strict_types=1);

namespace Odiseo\SyliusEasyPostPlugin\Fixture;

use Sylius\Bundle\CoreBundle\Fixture\AbstractResourceFixture;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

class EasyPostConfigurationFixture extends AbstractResourceFixture
{
    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        $node = $resourceNode->children();

        $node->scalarNode('code')->cannotBeEmpty();
        $node->scalarNode('api_key')->cannotBeEmpty();
        $node->arrayNode('sender_data')->variablePrototype();
        $node->booleanNode('enabled');
    }

    public function getName(): string
    {
        return 'easy_post_configuration';
    }
}
