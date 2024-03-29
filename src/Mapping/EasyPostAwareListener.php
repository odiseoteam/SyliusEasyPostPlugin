<?php

declare(strict_types=1);

namespace Odiseo\SyliusEasyPostPlugin\Mapping;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\Mapping\ClassMetadata;
use Odiseo\SyliusEasyPostPlugin\Entity\EasyPostAwareInterface;
use Sylius\Component\Shipping\Model\ShipmentInterface;

final class EasyPostAwareListener implements EventSubscriber
{
    public function getSubscribedEvents(): array
    {
        return [
            Events::loadClassMetadata,
        ];
    }

    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs): void
    {
        $classMetadata = $eventArgs->getClassMetadata();
        $reflection = $classMetadata->reflClass;

        /**
         * @phpstan-ignore-next-line
         */
        if ($reflection === null || $reflection->isAbstract()) {
            return;
        }

        if (
            $reflection->implementsInterface(ShipmentInterface::class) &&
            $reflection->implementsInterface(EasyPostAwareInterface::class)
        ) {
            $this->mapEasyPostAware($classMetadata);
        }
    }

    private function mapEasyPostAware(ClassMetadata $metadata): void
    {
        if (!$metadata->hasField('postageLabelUrl')) {
            $metadata->mapField([
                'fieldName' => 'postageLabelUrl',
                'columnName' => 'postage_label_url',
                'type' => 'string',
                'nullable' => true,
            ]);
        }
        if (!$metadata->hasField('rates')) {
            $metadata->mapField([
                'fieldName' => 'rates',
                'columnName' => 'rates',
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
