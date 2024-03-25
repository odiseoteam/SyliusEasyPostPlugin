<?php

declare(strict_types=1);

namespace Odiseo\SyliusEasyPostPlugin\Mapping;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping\MappingException;
use Odiseo\SyliusEasyPostPlugin\Entity\ShipmentAwareInterface;
use Sylius\Component\Resource\Metadata\RegistryInterface;

final class ShipmentAwareListener implements EventSubscriber
{
    /** @var RegistryInterface */
    private $resourceMetadataRegistry;

    /** @var string */
    private $itemClass;

    public function __construct(
        RegistryInterface $resourceMetadataRegistry,
        string $itemClass
    ) {
        $this->resourceMetadataRegistry = $resourceMetadataRegistry;
        $this->itemClass = $itemClass;
    }

    /**
     * {@inheritdoc}
     */
    public function getSubscribedEvents(): array
    {
        return [
            Events::loadClassMetadata,
        ];
    }

    /**
     * @throws MappingException
     */
    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs): void
    {
        $classMetadata = $eventArgs->getClassMetadata();
        $reflection = $classMetadata->reflClass;

        if (!$reflection instanceof \ReflectionClass || $reflection->isAbstract()) {
            return;
        }

        if (
        $reflection->implementsInterface(ShipmentAwareInterface::class)
        ) {
            $this->mapItemAware($classMetadata);
        }
    }

    /**
     * @throws MappingException
     */
    private function mapItemAware(ClassMetadata $metadata): void
    {
        if (!$metadata->hasField('postageLabelUrl')) {
            $metadata->mapField([
                'fieldName' => 'postageLabelUrl',
                'columnName' => 'postage_label_url',
                'type' => 'string',
                'nullable' => true,
            ]);
        }
        if (!$metadata->hasField('easyPostRates')) {
            $metadata->mapField([
                'fieldName' => 'easyPostRates',
                'columnName' => 'easy_post_rates',
                'type' => 'string',
                'nullable' => true,
            ]);
        }
        if (!$metadata->hasField('trackingUrl')) {
            $metadata->mapField([
                'fieldName' => 'trackingUrl',
                'columnName' => 'tracking_url',
                'type' => 'string',
                'nullable' => true,
            ]);
        }
    }
}
