<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230329133618 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "order" ALTER promo TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE "order" ALTER first_name TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE "order" ALTER middle_name TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE "order" ALTER last_name TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE "order" ALTER email TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE "order" ALTER line1 TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE "order" ALTER line2 TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE "order" ALTER city TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE "order" ALTER province TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE "order" ALTER country TYPE VARCHAR(255)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "order" ALTER promo TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE "order" ALTER first_name TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE "order" ALTER middle_name TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE "order" ALTER last_name TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE "order" ALTER email TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE "order" ALTER line1 TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE "order" ALTER line2 TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE "order" ALTER city TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE "order" ALTER province TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE "order" ALTER country TYPE VARCHAR(50)');
    }
}
