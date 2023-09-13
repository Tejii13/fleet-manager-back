<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230913072921 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE components (id INT AUTO_INCREMENT NOT NULL, category VARCHAR(50) NOT NULL, name VARCHAR(30) NOT NULL, size INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE components_loadout (components_id INT NOT NULL, loadout_id INT NOT NULL, INDEX IDX_2CEACA65CA91F907 (components_id), INDEX IDX_2CEACA657DFEF3F7 (loadout_id), PRIMARY KEY(components_id, loadout_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fleet (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_A05E1E477E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE loadout (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, ship_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, coolers VARCHAR(20) DEFAULT NULL, power_plant VARCHAR(20) DEFAULT NULL, shields VARCHAR(20) DEFAULT NULL, quantum_drive VARCHAR(20) DEFAULT NULL, missiles VARCHAR(20) DEFAULT NULL, turrets VARCHAR(20) DEFAULT NULL, utility_item VARCHAR(30) DEFAULT NULL, weapons VARCHAR(30) DEFAULT NULL, INDEX IDX_7E65CE427E3C61F9 (owner_id), INDEX IDX_7E65CE42C256317D (ship_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE loadout_components (loadout_id INT NOT NULL, components_id INT NOT NULL, INDEX IDX_CA7FDCF07DFEF3F7 (loadout_id), INDEX IDX_CA7FDCF0CA91F907 (components_id), PRIMARY KEY(loadout_id, components_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `member` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(60) NOT NULL, auth_token VARCHAR(64) NOT NULL, is_admin TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE preset (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_2C5FE4327E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE preset_components (preset_id INT NOT NULL, components_id INT NOT NULL, INDEX IDX_C03EA3ED80688E6F (preset_id), INDEX IDX_C03EA3EDCA91F907 (components_id), PRIMARY KEY(preset_id, components_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ship (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, unique_name VARCHAR(32) NOT NULL, INDEX IDX_FA30EB247E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE components_loadout ADD CONSTRAINT FK_2CEACA65CA91F907 FOREIGN KEY (components_id) REFERENCES components (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE components_loadout ADD CONSTRAINT FK_2CEACA657DFEF3F7 FOREIGN KEY (loadout_id) REFERENCES loadout (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fleet ADD CONSTRAINT FK_A05E1E477E3C61F9 FOREIGN KEY (owner_id) REFERENCES `member` (id)');
        $this->addSql('ALTER TABLE loadout ADD CONSTRAINT FK_7E65CE427E3C61F9 FOREIGN KEY (owner_id) REFERENCES `member` (id)');
        $this->addSql('ALTER TABLE loadout ADD CONSTRAINT FK_7E65CE42C256317D FOREIGN KEY (ship_id) REFERENCES ship (id)');
        $this->addSql('ALTER TABLE loadout_components ADD CONSTRAINT FK_CA7FDCF07DFEF3F7 FOREIGN KEY (loadout_id) REFERENCES loadout (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE loadout_components ADD CONSTRAINT FK_CA7FDCF0CA91F907 FOREIGN KEY (components_id) REFERENCES components (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE preset ADD CONSTRAINT FK_2C5FE4327E3C61F9 FOREIGN KEY (owner_id) REFERENCES `member` (id)');
        $this->addSql('ALTER TABLE preset_components ADD CONSTRAINT FK_C03EA3ED80688E6F FOREIGN KEY (preset_id) REFERENCES preset (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE preset_components ADD CONSTRAINT FK_C03EA3EDCA91F907 FOREIGN KEY (components_id) REFERENCES components (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ship ADD CONSTRAINT FK_FA30EB247E3C61F9 FOREIGN KEY (owner_id) REFERENCES `member` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE components_loadout DROP FOREIGN KEY FK_2CEACA65CA91F907');
        $this->addSql('ALTER TABLE components_loadout DROP FOREIGN KEY FK_2CEACA657DFEF3F7');
        $this->addSql('ALTER TABLE fleet DROP FOREIGN KEY FK_A05E1E477E3C61F9');
        $this->addSql('ALTER TABLE loadout DROP FOREIGN KEY FK_7E65CE427E3C61F9');
        $this->addSql('ALTER TABLE loadout DROP FOREIGN KEY FK_7E65CE42C256317D');
        $this->addSql('ALTER TABLE loadout_components DROP FOREIGN KEY FK_CA7FDCF07DFEF3F7');
        $this->addSql('ALTER TABLE loadout_components DROP FOREIGN KEY FK_CA7FDCF0CA91F907');
        $this->addSql('ALTER TABLE preset DROP FOREIGN KEY FK_2C5FE4327E3C61F9');
        $this->addSql('ALTER TABLE preset_components DROP FOREIGN KEY FK_C03EA3ED80688E6F');
        $this->addSql('ALTER TABLE preset_components DROP FOREIGN KEY FK_C03EA3EDCA91F907');
        $this->addSql('ALTER TABLE ship DROP FOREIGN KEY FK_FA30EB247E3C61F9');
        $this->addSql('DROP TABLE components');
        $this->addSql('DROP TABLE components_loadout');
        $this->addSql('DROP TABLE fleet');
        $this->addSql('DROP TABLE loadout');
        $this->addSql('DROP TABLE loadout_components');
        $this->addSql('DROP TABLE `member`');
        $this->addSql('DROP TABLE preset');
        $this->addSql('DROP TABLE preset_components');
        $this->addSql('DROP TABLE ship');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
