<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250109111917 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pointformat (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE championship ADD pointformat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE championship ADD CONSTRAINT FK_EBADDE6A6A8CE907 FOREIGN KEY (pointformat_id) REFERENCES pointformat (id)');
        $this->addSql('CREATE INDEX IDX_EBADDE6A6A8CE907 ON championship (pointformat_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE pointformat');
        $this->addSql('ALTER TABLE championship DROP FOREIGN KEY FK_EBADDE6A6A8CE907');
        $this->addSql('DROP INDEX IDX_EBADDE6A6A8CE907 ON championship');
        $this->addSql('ALTER TABLE championship DROP pointformat_id');
    }
}
