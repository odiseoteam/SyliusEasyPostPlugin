<?php

declare(strict_types=1);

namespace Odiseo\SyliusEasyPostPlugin\Repository;

use Odiseo\SyliusEasyPostPlugin\Entity\EasyPostConfigurationInterface;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

class EasyPostConfigurationRepository extends EntityRepository implements EasyPostConfigurationRepositoryInterface
{
    public function findOneByEnabled(): ?EasyPostConfigurationInterface
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.enabled = :enabled')
            ->setParameter('enabled', true)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
