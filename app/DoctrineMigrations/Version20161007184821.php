<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161007184821 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE company_id_seq CASCADE');
        $this->addSql('DROP TABLE company');
        $this->addSql('ALTER TABLE template ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE template ADD CONSTRAINT FK_97601F83A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_97601F83A76ED395 ON template (user_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE company_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE company (id INT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, customer_status VARCHAR(255) DEFAULT NULL, prospect_status VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, mobile_phone VARCHAR(255) DEFAULT NULL, work_phone VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(255) DEFAULT NULL, region VARCHAR(255) DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, tags VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_4fbf094fa76ed395 ON company (user_id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT fk_4fbf094fa76ed395 FOREIGN KEY (user_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE template DROP CONSTRAINT FK_97601F83A76ED395');
        $this->addSql('DROP INDEX IDX_97601F83A76ED395');
        $this->addSql('ALTER TABLE template DROP user_id');
    }
}
