<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161214113417 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE template_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE product_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE template (id INT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, code VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_97601F83A76ED395 ON template (user_id)');
        $this->addSql('CREATE TABLE product (id INT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, price VARCHAR(255) DEFAULT NULL, currency VARCHAR(255) DEFAULT NULL, code VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D34A04ADA76ED395 ON product (user_id)');
        $this->addSql('ALTER TABLE template ADD CONSTRAINT FK_97601F83A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADA76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE fos_user ADD email_server VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE fos_user ADD email_login VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE fos_user ADD email_password VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE fos_user ADD email_service_auto VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE fos_user DROP locked');
        $this->addSql('ALTER TABLE fos_user DROP expired');
        $this->addSql('ALTER TABLE fos_user DROP expires_at');
        $this->addSql('ALTER TABLE fos_user DROP credentials_expired');
        $this->addSql('ALTER TABLE fos_user DROP credentials_expire_at');
        $this->addSql('ALTER TABLE fos_user ALTER salt DROP NOT NULL');
        $this->addSql('ALTER TABLE deal ADD product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE deal ADD CONSTRAINT FK_E3FEC1164584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_E3FEC1164584665A ON deal (product_id)');
        $this->addSql('ALTER TABLE lead DROP group_id');
        $this->addSql('ALTER TABLE lead DROP tags');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE deal DROP CONSTRAINT FK_E3FEC1164584665A');
        $this->addSql('DROP SEQUENCE template_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE product_id_seq CASCADE');
        $this->addSql('DROP TABLE template');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP INDEX IDX_E3FEC1164584665A');
        $this->addSql('ALTER TABLE deal DROP product_id');
        $this->addSql('ALTER TABLE fos_user ADD locked BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE fos_user ADD expired BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE fos_user ADD expires_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE fos_user ADD credentials_expired BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE fos_user ADD credentials_expire_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE fos_user DROP email_server');
        $this->addSql('ALTER TABLE fos_user DROP email_login');
        $this->addSql('ALTER TABLE fos_user DROP email_password');
        $this->addSql('ALTER TABLE fos_user DROP email_service_auto');
        $this->addSql('ALTER TABLE fos_user ALTER salt SET NOT NULL');
        $this->addSql('ALTER TABLE lead ADD group_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE lead ADD tags VARCHAR(255) DEFAULT NULL');
    }
}
