<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231108144539 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD main_org_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6496B9FC40D FOREIGN KEY (main_org_id) REFERENCES organizations (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6496B9FC40D ON user (main_org_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6496B9FC40D');
        $this->addSql('DROP INDEX IDX_8D93D6496B9FC40D ON user');
        $this->addSql('ALTER TABLE user DROP main_org_id');
    }
}
