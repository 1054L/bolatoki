<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250308122949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE field ADD lat VARCHAR(100) DEFAULT NULL, ADD lng VARCHAR(100) DEFAULT NULL, ADD image VARCHAR(255) DEFAULT NULL, ADD images LONGTEXT DEFAULT NULL, ADD description LONGTEXT DEFAULT NULL, ADD is_covered TINYINT(1) NOT NULL, ADD maintenance VARCHAR(255) DEFAULT NULL, ADD address VARCHAR(255) DEFAULT NULL, ADD cp VARCHAR(100) DEFAULT NULL, ADD city VARCHAR(255) DEFAULT NULL, ADD province VARCHAR(255) DEFAULT NULL, ADD is_active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE player ADD is_federated TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE token token VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE field DROP lat, DROP lng, DROP image, DROP images, DROP description, DROP is_covered, DROP maintenance, DROP address, DROP cp, DROP city, DROP province, DROP is_active');
        $this->addSql('ALTER TABLE player DROP is_federated');
        $this->addSql('ALTER TABLE `user` CHANGE token token VARCHAR(255) NOT NULL');
    }
}
