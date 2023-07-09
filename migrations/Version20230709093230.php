<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230709093230 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE suppliers (id INT AUTO_INCREMENT NOT NULL, prefix VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, company VARCHAR(255) DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, is_active TINYINT(1) DEFAULT 1, discount INT DEFAULT NULL, discount_begin DATE DEFAULT NULL, discount_end DATE DEFAULT NULL, first_limit INT DEFAULT 50, second_limit INT DEFAULT 999, first_over_price DOUBLE PRECISION DEFAULT \'1.77\', second_over_price DOUBLE PRECISION DEFAULT \'1.65\', third_over_price DOUBLE PRECISION DEFAULT \'1.53\', label VARCHAR(255) DEFAULT NULL, personal_marks VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE suppliers');
    }
}
