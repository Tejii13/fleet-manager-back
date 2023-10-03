<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231003081801 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE organizations (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, sid VARCHAR(60) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_organizations (user_id INT NOT NULL, organizations_id INT NOT NULL, INDEX IDX_ACF2B12FA76ED395 (user_id), INDEX IDX_ACF2B12F86288A55 (organizations_id), PRIMARY KEY(user_id, organizations_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_organizations ADD CONSTRAINT FK_ACF2B12FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_organizations ADD CONSTRAINT FK_ACF2B12F86288A55 FOREIGN KEY (organizations_id) REFERENCES organizations (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_organizations DROP FOREIGN KEY FK_ACF2B12FA76ED395');
        $this->addSql('ALTER TABLE user_organizations DROP FOREIGN KEY FK_ACF2B12F86288A55');
        $this->addSql('DROP TABLE organizations');
        $this->addSql('DROP TABLE user_organizations');
    }
}
