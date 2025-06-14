<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250613113125 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE championship ADD mode_id INT NOT NULL');
        $this->addSql('ALTER TABLE championship ADD CONSTRAINT FK_EBADDE6A77E5854A FOREIGN KEY (mode_id) REFERENCES mode (id)');
        $this->addSql('CREATE INDEX IDX_EBADDE6A77E5854A ON championship (mode_id)');
        $this->addSql('ALTER TABLE field ADD mode_id INT NOT NULL');
        $this->addSql('ALTER TABLE field ADD CONSTRAINT FK_5BF5455877E5854A FOREIGN KEY (mode_id) REFERENCES mode (id)');
        $this->addSql('CREATE INDEX IDX_5BF5455877E5854A ON field (mode_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE championship DROP FOREIGN KEY FK_EBADDE6A77E5854A');
        $this->addSql('DROP INDEX IDX_EBADDE6A77E5854A ON championship');
        $this->addSql('ALTER TABLE championship DROP mode_id');
        $this->addSql('ALTER TABLE field DROP FOREIGN KEY FK_5BF5455877E5854A');
        $this->addSql('DROP INDEX IDX_5BF5455877E5854A ON field');
        $this->addSql('ALTER TABLE field DROP mode_id');
    }
}
