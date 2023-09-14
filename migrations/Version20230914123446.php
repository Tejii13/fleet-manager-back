<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230914123446 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE component_loadout (component_id INT NOT NULL, loadout_id INT NOT NULL, INDEX IDX_CE694F6BE2ABAFFF (component_id), INDEX IDX_CE694F6B7DFEF3F7 (loadout_id), PRIMARY KEY(component_id, loadout_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE component_loadout ADD CONSTRAINT FK_CE694F6BE2ABAFFF FOREIGN KEY (component_id) REFERENCES component (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE component_loadout ADD CONSTRAINT FK_CE694F6B7DFEF3F7 FOREIGN KEY (loadout_id) REFERENCES loadout (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE component_loadout DROP FOREIGN KEY FK_CE694F6BE2ABAFFF');
        $this->addSql('ALTER TABLE component_loadout DROP FOREIGN KEY FK_CE694F6B7DFEF3F7');
        $this->addSql('DROP TABLE component_loadout');
    }
}
