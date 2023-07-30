<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230520154216 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE refresh_token_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE refresh_token (id INT NOT NULL, refresh_token VARCHAR(128) NOT NULL, username VARCHAR(255) NOT NULL, valid TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C74F2195C74F2195 ON refresh_token (refresh_token)');
        $this->addSql('CREATE TABLE skills_skill (id VARCHAR(26) NOT NULL, skill_group_id VARCHAR(26) DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT \'\' NOT NULL, owner_id VARCHAR(26) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F3520F17BCFCB4B5 ON skills_skill (skill_group_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F3520F175E237E06BCFCB4B5 ON skills_skill (name, skill_group_id)');
        $this->addSql('CREATE TABLE skills_skill_group (id VARCHAR(26) NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT \'\' NOT NULL, owner_id VARCHAR(26) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ADFD070B5E237E06 ON skills_skill_group (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_ADFD070B7E3C61F95E237E06 ON skills_skill_group (owner_id, name)');
        $this->addSql('CREATE TABLE skills_specialist (id VARCHAR(26) NOT NULL, user_id VARCHAR(26) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE skills_specialist_speciality (specialist_id VARCHAR(26) NOT NULL, speciality_id VARCHAR(26) NOT NULL, PRIMARY KEY(specialist_id, speciality_id))');
        $this->addSql('CREATE INDEX IDX_9B70D7337B100C1A ON skills_specialist_speciality (specialist_id)');
        $this->addSql('CREATE INDEX IDX_9B70D7333B5A08D7 ON skills_specialist_speciality (speciality_id)');
        $this->addSql('CREATE TABLE skills_speciality (id VARCHAR(26) NOT NULL, owner_id VARCHAR(26) NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT \'\' NOT NULL, publication_status VARCHAR(50) DEFAULT \'draft\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE skills_speciality_skill (id VARCHAR(26) NOT NULL, speciality_id VARCHAR(26) NOT NULL, skill_id VARCHAR(26) NOT NULL, level VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A1DD72EA3B5A08D7 ON skills_speciality_skill (speciality_id)');
        $this->addSql('CREATE INDEX IDX_A1DD72EA5585C142 ON skills_speciality_skill (skill_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A1DD72EA3B5A08D75585C142 ON skills_speciality_skill (speciality_id, skill_id)');
        $this->addSql('CREATE TABLE users_user (id VARCHAR(26) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_421A9847E7927C74 ON users_user (email)');
        $this->addSql('ALTER TABLE skills_skill ADD CONSTRAINT FK_F3520F17BCFCB4B5 FOREIGN KEY (skill_group_id) REFERENCES skills_skill_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE skills_specialist_speciality ADD CONSTRAINT FK_9B70D7337B100C1A FOREIGN KEY (specialist_id) REFERENCES skills_specialist (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE skills_specialist_speciality ADD CONSTRAINT FK_9B70D7333B5A08D7 FOREIGN KEY (speciality_id) REFERENCES skills_speciality (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE skills_speciality_skill ADD CONSTRAINT FK_A1DD72EA3B5A08D7 FOREIGN KEY (speciality_id) REFERENCES skills_speciality (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE skills_speciality_skill ADD CONSTRAINT FK_A1DD72EA5585C142 FOREIGN KEY (skill_id) REFERENCES skills_skill (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE refresh_token_id_seq CASCADE');
        $this->addSql('ALTER TABLE skills_skill DROP CONSTRAINT FK_F3520F17BCFCB4B5');
        $this->addSql('ALTER TABLE skills_specialist_speciality DROP CONSTRAINT FK_9B70D7337B100C1A');
        $this->addSql('ALTER TABLE skills_specialist_speciality DROP CONSTRAINT FK_9B70D7333B5A08D7');
        $this->addSql('ALTER TABLE skills_speciality_skill DROP CONSTRAINT FK_A1DD72EA3B5A08D7');
        $this->addSql('ALTER TABLE skills_speciality_skill DROP CONSTRAINT FK_A1DD72EA5585C142');
        $this->addSql('DROP TABLE refresh_token');
        $this->addSql('DROP TABLE skills_skill');
        $this->addSql('DROP TABLE skills_skill_group');
        $this->addSql('DROP TABLE skills_specialist');
        $this->addSql('DROP TABLE skills_specialist_speciality');
        $this->addSql('DROP TABLE skills_speciality');
        $this->addSql('DROP TABLE skills_speciality_skill');
        $this->addSql('DROP TABLE users_user');
    }
}
