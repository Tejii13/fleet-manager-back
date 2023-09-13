<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230913142612 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ship ADD loadout_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ship ADD CONSTRAINT FK_FA30EB247DFEF3F7 FOREIGN KEY (loadout_id) REFERENCES loadout (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FA30EB247DFEF3F7 ON ship (loadout_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ship DROP FOREIGN KEY FK_FA30EB247DFEF3F7');
        $this->addSql('DROP INDEX UNIQ_FA30EB247DFEF3F7 ON ship');
        $this->addSql('ALTER TABLE ship DROP loadout_id');
    }
}
