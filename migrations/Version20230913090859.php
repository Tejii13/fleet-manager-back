<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230913090859 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE preset ADD for_ship_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE preset ADD CONSTRAINT FK_2C5FE432FE635650 FOREIGN KEY (for_ship_id) REFERENCES ship (id)');
        $this->addSql('CREATE INDEX IDX_2C5FE432FE635650 ON preset (for_ship_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE preset DROP FOREIGN KEY FK_2C5FE432FE635650');
        $this->addSql('DROP INDEX IDX_2C5FE432FE635650 ON preset');
        $this->addSql('ALTER TABLE preset DROP for_ship_id');
    }
}
