<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230307083224 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE cart_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE cart (id INT NOT NULL, orders_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, quantity VARCHAR(255) NOT NULL, sku VARCHAR(255) NOT NULL, discount DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BA388B7CFFE9AD6 ON cart (orders_id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES "order" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE cart_id_seq CASCADE');
        $this->addSql('ALTER TABLE cart DROP CONSTRAINT FK_BA388B7CFFE9AD6');
        $this->addSql('DROP TABLE cart');
    }
}
