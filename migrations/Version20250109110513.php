<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250109110513 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE clasification (id INT AUTO_INCREMENT NOT NULL, points INT DEFAULT NULL, championship_id INT NOT NULL, UNIQUE INDEX UNIQ_245DEE5794DDBCE9 (championship_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE clasification_player (clasification_id INT NOT NULL, player_id INT NOT NULL, INDEX IDX_44C5033EDA950E0A (clasification_id), INDEX IDX_44C5033E99E6F5DF (player_id), PRIMARY KEY(clasification_id, player_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE clasification ADD CONSTRAINT FK_245DEE5794DDBCE9 FOREIGN KEY (championship_id) REFERENCES championship (id)');
        $this->addSql('ALTER TABLE clasification_player ADD CONSTRAINT FK_44C5033EDA950E0A FOREIGN KEY (clasification_id) REFERENCES clasification (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE clasification_player ADD CONSTRAINT FK_44C5033E99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clasification DROP FOREIGN KEY FK_245DEE5794DDBCE9');
        $this->addSql('ALTER TABLE clasification_player DROP FOREIGN KEY FK_44C5033EDA950E0A');
        $this->addSql('ALTER TABLE clasification_player DROP FOREIGN KEY FK_44C5033E99E6F5DF');
        $this->addSql('DROP TABLE clasification');
        $this->addSql('DROP TABLE clasification_player');
    }
}
