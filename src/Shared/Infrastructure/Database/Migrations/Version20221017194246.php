<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221017194246 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE companies_company (id VARCHAR(26) NOT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, owner_id VARCHAR(26) NOT NULL, contact_person_firstname VARCHAR(255) NOT NULL, contact_person_lastname VARCHAR(255) NOT NULL, contact_person_email VARCHAR(255) NOT NULL, contact_person_phone_number VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_93CE802F5E237E067E3C61F9 ON companies_company (name, owner_id)');
        $this->addSql('COMMENT ON COLUMN companies_company.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE companies_employee (id VARCHAR(26) NOT NULL, company_id VARCHAR(26) DEFAULT NULL, hired BOOLEAN DEFAULT false NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, hired_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, user_id VARCHAR(26) NOT NULL, contact_firstname VARCHAR(255) NOT NULL, contact_lastname VARCHAR(255) NOT NULL, contact_email VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_10F16570979B1AD6 ON companies_employee (company_id)');
        $this->addSql('COMMENT ON COLUMN companies_employee.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN companies_employee.hired_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE companies_invite (id VARCHAR(26) NOT NULL, employee_id VARCHAR(26) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6066BFF98C03F15C ON companies_invite (employee_id)');
        $this->addSql('COMMENT ON COLUMN companies_invite.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE companies_employee ADD CONSTRAINT FK_10F16570979B1AD6 FOREIGN KEY (company_id) REFERENCES companies_company (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE companies_invite ADD CONSTRAINT FK_6066BFF98C03F15C FOREIGN KEY (employee_id) REFERENCES companies_employee (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE companies_employee DROP CONSTRAINT FK_10F16570979B1AD6');
        $this->addSql('ALTER TABLE companies_invite DROP CONSTRAINT FK_6066BFF98C03F15C');
        $this->addSql('DROP TABLE companies_company');
        $this->addSql('DROP TABLE companies_employee');
        $this->addSql('DROP TABLE companies_invite');
    }
}
