<?php

declare(strict_types=1);

namespace Odiseo\SyliusEasyPostPlugin\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240401140955 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE odiseo_easy_post_configuration (id INT AUTO_INCREMENT NOT NULL, sender_data_id INT DEFAULT NULL, code VARCHAR(255) NOT NULL, api_key VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_9F734EB477153098 (code), UNIQUE INDEX UNIQ_9F734EB4BA0367F7 (sender_data_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE odiseo_easy_post_configuration_sender_data (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, street VARCHAR(255) DEFAULT NULL, company VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, postcode VARCHAR(255) DEFAULT NULL, country_code VARCHAR(255) DEFAULT NULL, province_code VARCHAR(255) DEFAULT NULL, province_name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE odiseo_easy_post_configuration ADD CONSTRAINT FK_9F734EB4BA0367F7 FOREIGN KEY (sender_data_id) REFERENCES odiseo_easy_post_configuration_sender_data (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sylius_shipment ADD postage_label_url VARCHAR(255) DEFAULT NULL, ADD rates VARCHAR(255) DEFAULT NULL, ADD tracking_url VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE odiseo_easy_post_configuration DROP FOREIGN KEY FK_9F734EB4BA0367F7');
        $this->addSql('DROP TABLE odiseo_easy_post_configuration');
        $this->addSql('DROP TABLE odiseo_easy_post_configuration_sender_data');
        $this->addSql('ALTER TABLE sylius_shipment DROP postage_label_url, DROP rates, DROP tracking_url');
    }
}
