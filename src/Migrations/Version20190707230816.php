<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190707230816 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE fav_clubs (id INT AUTO_INCREMENT NOT NULL, club_id INT NOT NULL, league_id INT NOT NULL, league_name VARCHAR(255) NOT NULL, club_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fav_clubs_user (fav_clubs_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_B5CC92AE31B917C1 (fav_clubs_id), INDEX IDX_B5CC92AEA76ED395 (user_id), PRIMARY KEY(fav_clubs_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fav_clubs_user ADD CONSTRAINT FK_B5CC92AE31B917C1 FOREIGN KEY (fav_clubs_id) REFERENCES fav_clubs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fav_clubs_user ADD CONSTRAINT FK_B5CC92AEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fav_clubs_user DROP FOREIGN KEY FK_B5CC92AE31B917C1');
        $this->addSql('DROP TABLE fav_clubs');
        $this->addSql('DROP TABLE fav_clubs_user');
    }
}
