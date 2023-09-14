<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230914123225 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE component (id INT AUTO_INCREMENT NOT NULL, category VARCHAR(30) NOT NULL, name VARCHAR(30) NOT NULL, size INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE loadout (id INT AUTO_INCREMENT NOT NULL, for_ship_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, power_plant JSON DEFAULT NULL, cooler JSON DEFAULT NULL, shield JSON DEFAULT NULL, quantum_drive JSON DEFAULT NULL, weapon JSON DEFAULT NULL, missile JSON DEFAULT NULL, turret JSON DEFAULT NULL, utility_item JSON DEFAULT NULL, INDEX IDX_7E65CE42FE635650 (for_ship_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `member` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(60) NOT NULL, auth_token VARCHAR(64) NOT NULL, is_admin TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ship (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, nickname VARCHAR(32) DEFAULT NULL, INDEX IDX_FA30EB247E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE loadout ADD CONSTRAINT FK_7E65CE42FE635650 FOREIGN KEY (for_ship_id) REFERENCES ship (id)');
        $this->addSql('ALTER TABLE ship ADD CONSTRAINT FK_FA30EB247E3C61F9 FOREIGN KEY (owner_id) REFERENCES `member` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE loadout DROP FOREIGN KEY FK_7E65CE42FE635650');
        $this->addSql('ALTER TABLE ship DROP FOREIGN KEY FK_FA30EB247E3C61F9');
        $this->addSql('DROP TABLE component');
        $this->addSql('DROP TABLE loadout');
        $this->addSql('DROP TABLE `member`');
        $this->addSql('DROP TABLE ship');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
