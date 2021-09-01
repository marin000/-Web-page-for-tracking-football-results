<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190628152254 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE competition_info (id INT AUTO_INCREMENT NOT NULL, comp_id INT NOT NULL, current_champ VARCHAR(255) NOT NULL, most_champ VARCHAR(255) NOT NULL, relegation_to VARCHAR(255) NOT NULL, teams_br VARCHAR(20) NOT NULL, most_app VARCHAR(255) NOT NULL, top_scorer VARCHAR(255) NOT NULL, goals_per_match VARCHAR(255) NOT NULL, home_wins VARCHAR(255) NOT NULL, tie VARCHAR(255) NOT NULL, away_wins VARCHAR(255) NOT NULL, yellow_card VARCHAR(255) NOT NULL, red_card VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE competition_info');
    }
}
