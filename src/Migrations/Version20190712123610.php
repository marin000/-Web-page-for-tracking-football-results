<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190712123610 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE quiz (id INT AUTO_INCREMENT NOT NULL, quest1 VARCHAR(255) NOT NULL, quest2 VARCHAR(255) NOT NULL, quest3 VARCHAR(255) NOT NULL, quest4 VARCHAR(255) NOT NULL, quest5 VARCHAR(255) NOT NULL, ans1a VARCHAR(255) NOT NULL, ans1b VARCHAR(255) NOT NULL, ans1c VARCHAR(255) NOT NULL, ans2a VARCHAR(255) NOT NULL, ans2b VARCHAR(255) NOT NULL, ans2c VARCHAR(255) NOT NULL, ans3a VARCHAR(255) NOT NULL, ans3b VARCHAR(255) NOT NULL, ans3c VARCHAR(255) NOT NULL, ans4a VARCHAR(255) NOT NULL, ans4b VARCHAR(255) NOT NULL, ans4c VARCHAR(255) NOT NULL, ans5a VARCHAR(255) NOT NULL, ans5b VARCHAR(255) NOT NULL, ans5c VARCHAR(255) NOT NULL, ans1correct VARCHAR(255) NOT NULL, ans2correct VARCHAR(255) NOT NULL, ans3correct VARCHAR(255) NOT NULL, ans4correct VARCHAR(255) NOT NULL, ans5correct VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE quiz');
    }
}
