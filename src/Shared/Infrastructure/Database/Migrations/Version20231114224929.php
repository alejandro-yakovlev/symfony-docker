<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231114224929 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE skills_skill_confirmation (id VARCHAR(26) NOT NULL, specialist_id VARCHAR(26) DEFAULT NULL, skill_id VARCHAR(26) DEFAULT NULL, level VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_722F1C197B100C1A ON skills_skill_confirmation (specialist_id)');
        $this->addSql('CREATE INDEX IDX_722F1C195585C142 ON skills_skill_confirmation (skill_id)');
        $this->addSql('CREATE TABLE skills_skill_confirmation_proof (id VARCHAR(26) NOT NULL, skill_confirmation_id VARCHAR(26) DEFAULT NULL, test_id VARCHAR(26) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5F2C86C75D6D96DB ON skills_skill_confirmation_proof (skill_confirmation_id)');
        $this->addSql('ALTER TABLE skills_skill_confirmation ADD CONSTRAINT FK_722F1C197B100C1A FOREIGN KEY (specialist_id) REFERENCES skills_specialist (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE skills_skill_confirmation ADD CONSTRAINT FK_722F1C195585C142 FOREIGN KEY (skill_id) REFERENCES skills_skill (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE skills_skill_confirmation_proof ADD CONSTRAINT FK_5F2C86C75D6D96DB FOREIGN KEY (skill_confirmation_id) REFERENCES skills_skill_confirmation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE skills_skill_confirmation DROP CONSTRAINT FK_722F1C197B100C1A');
        $this->addSql('ALTER TABLE skills_skill_confirmation DROP CONSTRAINT FK_722F1C195585C142');
        $this->addSql('ALTER TABLE skills_skill_confirmation_proof DROP CONSTRAINT FK_5F2C86C75D6D96DB');
        $this->addSql('DROP TABLE skills_skill_confirmation');
        $this->addSql('DROP TABLE skills_skill_confirmation_proof');
    }
}
