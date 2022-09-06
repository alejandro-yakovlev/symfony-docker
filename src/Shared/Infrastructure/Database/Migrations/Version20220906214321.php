<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220906214321 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE testing_answer_option (id VARCHAR(26) NOT NULL, question_id VARCHAR(26) DEFAULT NULL, description VARCHAR(255) NOT NULL, correct BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_62DD1EDE1E27F6BF ON testing_answer_option (question_id)');
        $this->addSql('CREATE TABLE testing_question (id VARCHAR(26) NOT NULL, test_id VARCHAR(26) DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, position_number INT NOT NULL, published BOOLEAN NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_804A23015E237E06 ON testing_question (name)');
        $this->addSql('CREATE INDEX IDX_804A23011E5D0459 ON testing_question (test_id)');
        $this->addSql('CREATE TABLE testing_test (id VARCHAR(26) NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, correct_answers_percentage INT DEFAULT 0 NOT NULL, published BOOLEAN NOT NULL, skill_id VARCHAR(26) DEFAULT NULL, difficulty_level VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, creator_id VARCHAR(26) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8F8FA01C5E237E06 ON testing_test (name)');
        $this->addSql('COMMENT ON COLUMN testing_test.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN testing_test.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN testing_test.deleted_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE testing_answer_option ADD CONSTRAINT FK_62DD1EDE1E27F6BF FOREIGN KEY (question_id) REFERENCES testing_question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE testing_question ADD CONSTRAINT FK_804A23011E5D0459 FOREIGN KEY (test_id) REFERENCES testing_test (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE testing_answer_option DROP CONSTRAINT FK_62DD1EDE1E27F6BF');
        $this->addSql('ALTER TABLE testing_question DROP CONSTRAINT FK_804A23011E5D0459');
        $this->addSql('DROP TABLE testing_answer_option');
        $this->addSql('DROP TABLE testing_question');
        $this->addSql('DROP TABLE testing_test');
    }
}
