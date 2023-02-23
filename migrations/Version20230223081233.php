<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230223081233 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE "order_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "order" (id INT NOT NULL, token VARCHAR(100) NOT NULL, status SMALLINT NOT NULL, sub_total DOUBLE PRECISION NOT NULL, item_discount DOUBLE PRECISION NOT NULL, tax DOUBLE PRECISION NOT NULL, shipping DOUBLE PRECISION NOT NULL, total DOUBLE PRECISION NOT NULL, promo VARCHAR(50) DEFAULT NULL, discount DOUBLE PRECISION NOT NULL, grand_total DOUBLE PRECISION NOT NULL, first_name VARCHAR(50) NOT NULL, middle_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, mobile VARCHAR(15) NOT NULL, email VARCHAR(50) NOT NULL, line1 VARCHAR(50) NOT NULL, line2 VARCHAR(50) NOT NULL, city VARCHAR(50) NOT NULL, province VARCHAR(50) NOT NULL, country VARCHAR(50) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, content TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN "order".created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN "order".updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE product ADD user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD9D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D34A04AD9D86650F ON product (user_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE "order_id_seq" CASCADE');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04AD9D86650F');
        $this->addSql('DROP INDEX IDX_D34A04AD9D86650F');
        $this->addSql('ALTER TABLE product DROP user_id_id');
    }
}
