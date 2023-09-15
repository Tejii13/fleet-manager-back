<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230915135400 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE components (id INT AUTO_INCREMENT NOT NULL, category VARCHAR(50) NOT NULL, name VARCHAR(50) NOT NULL, size INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE components_loadout (components_id INT NOT NULL, loadout_id INT NOT NULL, INDEX IDX_2CEACA65CA91F907 (components_id), INDEX IDX_2CEACA657DFEF3F7 (loadout_id), PRIMARY KEY(components_id, loadout_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE loadout (id INT AUTO_INCREMENT NOT NULL, for_ship_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, power_plants JSON DEFAULT NULL, coolers JSON DEFAULT NULL, shields JSON DEFAULT NULL, quantum_drive JSON DEFAULT NULL, weapons JSON DEFAULT NULL, missiles JSON DEFAULT NULL, turrets JSON DEFAULT NULL, utility_items JSON DEFAULT NULL, INDEX IDX_7E65CE42FE635650 (for_ship_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ship (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, nickname VARCHAR(32) DEFAULT NULL, size INT NOT NULL, INDEX IDX_FA30EB247E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE components_loadout ADD CONSTRAINT FK_2CEACA65CA91F907 FOREIGN KEY (components_id) REFERENCES components (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE components_loadout ADD CONSTRAINT FK_2CEACA657DFEF3F7 FOREIGN KEY (loadout_id) REFERENCES loadout (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE loadout ADD CONSTRAINT FK_7E65CE42FE635650 FOREIGN KEY (for_ship_id) REFERENCES ship (id)');
        $this->addSql('ALTER TABLE ship ADD CONSTRAINT FK_FA30EB247E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE components_loadout DROP FOREIGN KEY FK_2CEACA65CA91F907');
        $this->addSql('ALTER TABLE components_loadout DROP FOREIGN KEY FK_2CEACA657DFEF3F7');
        $this->addSql('ALTER TABLE loadout DROP FOREIGN KEY FK_7E65CE42FE635650');
        $this->addSql('ALTER TABLE ship DROP FOREIGN KEY FK_FA30EB247E3C61F9');
        $this->addSql('DROP TABLE components');
        $this->addSql('DROP TABLE components_loadout');
        $this->addSql('DROP TABLE loadout');
        $this->addSql('DROP TABLE ship');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
