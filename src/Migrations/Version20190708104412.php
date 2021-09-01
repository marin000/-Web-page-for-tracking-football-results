<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190708104412 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE fav_player (id INT AUTO_INCREMENT NOT NULL, league_name VARCHAR(255) NOT NULL, league_id INT NOT NULL, club_id INT NOT NULL, player_id INT NOT NULL, player_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fav_player_user (fav_player_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_B635AD1B33F2C762 (fav_player_id), INDEX IDX_B635AD1BA76ED395 (user_id), PRIMARY KEY(fav_player_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fav_player_user ADD CONSTRAINT FK_B635AD1B33F2C762 FOREIGN KEY (fav_player_id) REFERENCES fav_player (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fav_player_user ADD CONSTRAINT FK_B635AD1BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fav_player_user DROP FOREIGN KEY FK_B635AD1B33F2C762');
        $this->addSql('DROP TABLE fav_player');
        $this->addSql('DROP TABLE fav_player_user');
    }
}
