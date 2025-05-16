<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241230110129 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE championship (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE club (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, location VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE field (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, location VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, date DATE NOT NULL, format SMALLINT NOT NULL, field_id INT NOT NULL, INDEX IDX_232B318C443707B0 (field_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE game_championship (game_id INT NOT NULL, championship_id INT NOT NULL, INDEX IDX_57DEA04E48FD905 (game_id), INDEX IDX_57DEA0494DDBCE9 (championship_id), PRIMARY KEY(game_id, championship_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE player (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, birthdate DATE DEFAULT NULL, gender SMALLINT NOT NULL, province VARCHAR(255) DEFAULT NULL, club_id INT DEFAULT NULL, user_id INT DEFAULT NULL, INDEX IDX_98197A6561190A32 (club_id), UNIQUE INDEX UNIQ_98197A65A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE stake (id INT AUTO_INCREMENT NOT NULL, run_test SMALLINT DEFAULT NULL, run_one SMALLINT DEFAULT NULL, run_two SMALLINT DEFAULT NULL, run_three SMALLINT DEFAULT NULL, run_four SMALLINT DEFAULT NULL, run_five SMALLINT DEFAULT NULL, run_six SMALLINT DEFAULT NULL, run_seven SMALLINT DEFAULT NULL, run_eight SMALLINT DEFAULT NULL, total SMALLINT DEFAULT NULL, player_id INT NOT NULL, game_id INT NOT NULL, INDEX IDX_6EC9DC6599E6F5DF (player_id), INDEX IDX_6EC9DC65E48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE total_player_championship (id INT AUTO_INCREMENT NOT NULL, total INT NOT NULL, player_id INT NOT NULL, championship_id INT NOT NULL, INDEX IDX_659A075B99E6F5DF (player_id), INDEX IDX_659A075B94DDBCE9 (championship_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, phone INT DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C443707B0 FOREIGN KEY (field_id) REFERENCES field (id)');
        $this->addSql('ALTER TABLE game_championship ADD CONSTRAINT FK_57DEA04E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_championship ADD CONSTRAINT FK_57DEA0494DDBCE9 FOREIGN KEY (championship_id) REFERENCES championship (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A6561190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE stake ADD CONSTRAINT FK_6EC9DC6599E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE stake ADD CONSTRAINT FK_6EC9DC65E48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE total_player_championship ADD CONSTRAINT FK_659A075B99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE total_player_championship ADD CONSTRAINT FK_659A075B94DDBCE9 FOREIGN KEY (championship_id) REFERENCES championship (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C443707B0');
        $this->addSql('ALTER TABLE game_championship DROP FOREIGN KEY FK_57DEA04E48FD905');
        $this->addSql('ALTER TABLE game_championship DROP FOREIGN KEY FK_57DEA0494DDBCE9');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A6561190A32');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A65A76ED395');
        $this->addSql('ALTER TABLE stake DROP FOREIGN KEY FK_6EC9DC6599E6F5DF');
        $this->addSql('ALTER TABLE stake DROP FOREIGN KEY FK_6EC9DC65E48FD905');
        $this->addSql('ALTER TABLE total_player_championship DROP FOREIGN KEY FK_659A075B99E6F5DF');
        $this->addSql('ALTER TABLE total_player_championship DROP FOREIGN KEY FK_659A075B94DDBCE9');
        $this->addSql('DROP TABLE championship');
        $this->addSql('DROP TABLE club');
        $this->addSql('DROP TABLE field');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE game_championship');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE stake');
        $this->addSql('DROP TABLE total_player_championship');
        $this->addSql('DROP TABLE user');
    }
}
