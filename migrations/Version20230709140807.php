<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230709140807 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, supplier_id INT DEFAULT NULL, prom_group_id INT DEFAULT NULL, category_id INT NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, is_active TINYINT(1) DEFAULT 1, is_rrc TINYINT(1) DEFAULT NULL, INDEX IDX_3AF346682ADD6D8C (supplier_id), INDEX IDX_3AF34668AC5940DA (prom_group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categories ADD CONSTRAINT FK_3AF346682ADD6D8C FOREIGN KEY (supplier_id) REFERENCES suppliers (id)');
        $this->addSql('ALTER TABLE categories ADD CONSTRAINT FK_3AF34668AC5940DA FOREIGN KEY (prom_group_id) REFERENCES prom_groups (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categories DROP FOREIGN KEY FK_3AF346682ADD6D8C');
        $this->addSql('ALTER TABLE categories DROP FOREIGN KEY FK_3AF34668AC5940DA');
        $this->addSql('DROP TABLE categories');
    }
}
