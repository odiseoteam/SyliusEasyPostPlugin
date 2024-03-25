<?php

declare(strict_types=1);

namespace Odiseo\SyliusEasyPostPlugin\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240325173021 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE odiseo_easy_post_configuration (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, api_key VARCHAR(255) NOT NULL, street1 VARCHAR(255) NOT NULL, street2 VARCHAR(255) DEFAULT NULL, city VARCHAR(255) NOT NULL, state VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, zip VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, enabled TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_9F734EB45E237E06 (name), UNIQUE INDEX UNIQ_9F734EB4C912ED9D (api_key), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sylius_shipment ADD postage_label_url VARCHAR(255) DEFAULT NULL, ADD easy_post_rates VARCHAR(255) DEFAULT NULL, ADD tracking_url VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE odiseo_easy_post_configuration');
        $this->addSql('ALTER TABLE sylius_shipment DROP postage_label_url, DROP easy_post_rates, DROP tracking_url');
    }
}
