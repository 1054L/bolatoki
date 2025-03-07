<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241231112034 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE format (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, testrun TINYINT(1) NOT NULL, num_runs INT NOT NULL, remove_minor TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE game ADD format_id INT NOT NULL, DROP format');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CD629F605 FOREIGN KEY (format_id) REFERENCES format (id)');
        $this->addSql('CREATE INDEX IDX_232B318CD629F605 ON game (format_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE format');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CD629F605');
        $this->addSql('DROP INDEX IDX_232B318CD629F605 ON game');
        $this->addSql('ALTER TABLE game ADD format SMALLINT NOT NULL, DROP format_id');
    }
}
