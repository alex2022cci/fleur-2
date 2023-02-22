<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230222085516 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "user" ALTER first_name TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE "user" ALTER middle_name TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE "user" ALTER last_name TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE "user" ALTER mobile TYPE VARCHAR(255)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "user" ALTER first_name TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE "user" ALTER middle_name TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE "user" ALTER last_name TYPE VARCHAR(50)');
        $this->addSql('ALTER TABLE "user" ALTER mobile TYPE VARCHAR(15)');
    }
}
