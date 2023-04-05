<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230404141527 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "order" ALTER token TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE "order" ALTER mobile TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE "order" ALTER zip TYPE VARCHAR(255)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "order" ALTER token TYPE VARCHAR(100)');
        $this->addSql('ALTER TABLE "order" ALTER mobile TYPE VARCHAR(15)');
        $this->addSql('ALTER TABLE "order" ALTER zip TYPE VARCHAR(10)');
    }
}
