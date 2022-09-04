<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220904182445 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE skills_skill (id VARCHAR(26) NOT NULL, skill_group_id VARCHAR(26) DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F3520F175E237E06 ON skills_skill (name)');
        $this->addSql('CREATE INDEX IDX_F3520F17BCFCB4B5 ON skills_skill (skill_group_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F3520F175E237E06BCFCB4B5 ON skills_skill (name, skill_group_id)');
        $this->addSql('ALTER TABLE skills_skill ADD CONSTRAINT FK_F3520F17BCFCB4B5 FOREIGN KEY (skill_group_id) REFERENCES skills_skill_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE skills_skill DROP CONSTRAINT FK_F3520F17BCFCB4B5');
        $this->addSql('DROP TABLE skills_skill');
    }
}
