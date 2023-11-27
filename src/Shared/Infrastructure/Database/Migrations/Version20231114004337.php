<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231114004337 extends AbstractMigration
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
        $this->addSql('CREATE TABLE testing_question (id VARCHAR(26) NOT NULL, test_id VARCHAR(26) DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, position_number INT DEFAULT NULL, published BOOLEAN NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_804A23011E5D0459 ON testing_question (test_id)');
        $this->addSql('CREATE TABLE testing_test (id VARCHAR(26) NOT NULL, owner_id VARCHAR(26) NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, correct_answers_percentage INT DEFAULT 0 NOT NULL, published BOOLEAN NOT NULL, skill_id VARCHAR(26) DEFAULT NULL, difficulty_level VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8F8FA01C5E237E06 ON testing_test (name)');
        $this->addSql('COMMENT ON COLUMN testing_test.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN testing_test.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN testing_test.deleted_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE testing_testing_session (id VARCHAR(26) NOT NULL, test_id VARCHAR(26) DEFAULT NULL, user_id VARCHAR(26) NOT NULL, correct_answers_percentage INT DEFAULT 0 NOT NULL, is_passed_successfully BOOLEAN NOT NULL, started_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, completed_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_485F2E0A1E5D0459 ON testing_testing_session (test_id)');
        $this->addSql('COMMENT ON COLUMN testing_testing_session.started_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN testing_testing_session.completed_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE testing_user_answer (id VARCHAR(26) NOT NULL, testing_session_id VARCHAR(26) DEFAULT NULL, question_id VARCHAR(26) DEFAULT NULL, answered_options TEXT DEFAULT \'[]\' NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EE8BD7CFBBB901EE ON testing_user_answer (testing_session_id)');
        $this->addSql('CREATE INDEX IDX_EE8BD7CF1E27F6BF ON testing_user_answer (question_id)');
        $this->addSql('COMMENT ON COLUMN testing_user_answer.answered_options IS \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE testing_answer_option ADD CONSTRAINT FK_62DD1EDE1E27F6BF FOREIGN KEY (question_id) REFERENCES testing_question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE testing_question ADD CONSTRAINT FK_804A23011E5D0459 FOREIGN KEY (test_id) REFERENCES testing_test (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE testing_testing_session ADD CONSTRAINT FK_485F2E0A1E5D0459 FOREIGN KEY (test_id) REFERENCES testing_test (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE testing_user_answer ADD CONSTRAINT FK_EE8BD7CFBBB901EE FOREIGN KEY (testing_session_id) REFERENCES testing_testing_session (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE testing_user_answer ADD CONSTRAINT FK_EE8BD7CF1E27F6BF FOREIGN KEY (question_id) REFERENCES testing_question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE testing_answer_option DROP CONSTRAINT FK_62DD1EDE1E27F6BF');
        $this->addSql('ALTER TABLE testing_question DROP CONSTRAINT FK_804A23011E5D0459');
        $this->addSql('ALTER TABLE testing_testing_session DROP CONSTRAINT FK_485F2E0A1E5D0459');
        $this->addSql('ALTER TABLE testing_user_answer DROP CONSTRAINT FK_EE8BD7CFBBB901EE');
        $this->addSql('ALTER TABLE testing_user_answer DROP CONSTRAINT FK_EE8BD7CF1E27F6BF');
        $this->addSql('DROP TABLE testing_answer_option');
        $this->addSql('DROP TABLE testing_question');
        $this->addSql('DROP TABLE testing_test');
        $this->addSql('DROP TABLE testing_testing_session');
        $this->addSql('DROP TABLE testing_user_answer');
    }
}
