<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250527065219 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clasification CHANGE championship_id championship_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE field CHANGE lat lat VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE player CHANGE federated federated TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE token token VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clasification CHANGE championship_id championship_id INT NOT NULL');
        $this->addSql('ALTER TABLE field CHANGE lat lat VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE player CHANGE federated federated TINYINT(1) DEFAULT 1 NOT NULL');
        $this->addSql('ALTER TABLE `user` CHANGE token token TEXT DEFAULT NULL');
    }
}
