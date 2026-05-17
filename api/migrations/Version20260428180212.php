<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260428180212 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mode (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, pins INT DEFAULT NULL, rules VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE championship ADD mode_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE championship ADD CONSTRAINT FK_EBADDE6A77E5854A FOREIGN KEY (mode_id) REFERENCES mode (id)');
        $this->addSql('CREATE INDEX IDX_EBADDE6A77E5854A ON championship (mode_id)');
        $this->addSql('ALTER TABLE clasification CHANGE championship_id championship_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE field ADD lng VARCHAR(100) DEFAULT NULL, ADD image VARCHAR(255) DEFAULT NULL, ADD images LONGTEXT DEFAULT NULL, ADD description LONGTEXT DEFAULT NULL, ADD is_covered TINYINT(1) NOT NULL, ADD maintenance VARCHAR(255) DEFAULT NULL, ADD address VARCHAR(255) DEFAULT NULL, ADD cp VARCHAR(100) DEFAULT NULL, ADD city VARCHAR(255) DEFAULT NULL, ADD province VARCHAR(255) DEFAULT NULL, ADD is_active TINYINT(1) NOT NULL, ADD mode_id INT DEFAULT NULL, CHANGE location lat VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE field ADD CONSTRAINT FK_5BF5455877E5854A FOREIGN KEY (mode_id) REFERENCES mode (id)');
        $this->addSql('CREATE INDEX IDX_5BF5455877E5854A ON field (mode_id)');
        $this->addSql('ALTER TABLE game CHANGE date date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE player ADD federated TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE stake ADD position INT NOT NULL');
        $this->addSql('DROP INDEX UNIQ_IDENTIFIER_USERNAME ON user');
        $this->addSql('ALTER TABLE user ADD type INT NOT NULL, ADD token VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE mode');
        $this->addSql('ALTER TABLE player DROP federated');
        $this->addSql('ALTER TABLE stake DROP position');
        $this->addSql('ALTER TABLE game CHANGE date date DATE NOT NULL');
        $this->addSql('ALTER TABLE clasification CHANGE championship_id championship_id INT NOT NULL');
        $this->addSql('ALTER TABLE field DROP FOREIGN KEY FK_5BF5455877E5854A');
        $this->addSql('DROP INDEX IDX_5BF5455877E5854A ON field');
        $this->addSql('ALTER TABLE field ADD location VARCHAR(255) DEFAULT NULL, DROP lat, DROP lng, DROP image, DROP images, DROP description, DROP is_covered, DROP maintenance, DROP address, DROP cp, DROP city, DROP province, DROP is_active, DROP mode_id');
        $this->addSql('ALTER TABLE `user` DROP type, DROP token');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME ON `user` (username)');
        $this->addSql('ALTER TABLE championship DROP FOREIGN KEY FK_EBADDE6A77E5854A');
        $this->addSql('DROP INDEX IDX_EBADDE6A77E5854A ON championship');
        $this->addSql('ALTER TABLE championship DROP mode_id');
    }
}
