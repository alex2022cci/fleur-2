<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230302095811 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "order" ALTER token DROP NOT NULL');
        $this->addSql('ALTER TABLE "order" ALTER status DROP NOT NULL');
        $this->addSql('ALTER TABLE "order" ALTER sub_total DROP NOT NULL');
        $this->addSql('ALTER TABLE "order" ALTER item_discount DROP NOT NULL');
        $this->addSql('ALTER TABLE "order" ALTER tax DROP NOT NULL');
        $this->addSql('ALTER TABLE "order" ALTER shipping DROP NOT NULL');
        $this->addSql('ALTER TABLE "order" ALTER total DROP NOT NULL');
        $this->addSql('ALTER TABLE "order" ALTER discount DROP NOT NULL');
        $this->addSql('ALTER TABLE "order" ALTER grand_total DROP NOT NULL');
        $this->addSql('ALTER TABLE "order" ALTER middle_name DROP NOT NULL');
        $this->addSql('ALTER TABLE "order" ALTER email DROP NOT NULL');
        $this->addSql('ALTER TABLE "order" ALTER line2 DROP NOT NULL');
        $this->addSql('ALTER TABLE "order" ALTER content DROP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "order" ALTER token SET NOT NULL');
        $this->addSql('ALTER TABLE "order" ALTER status SET NOT NULL');
        $this->addSql('ALTER TABLE "order" ALTER sub_total SET NOT NULL');
        $this->addSql('ALTER TABLE "order" ALTER item_discount SET NOT NULL');
        $this->addSql('ALTER TABLE "order" ALTER tax SET NOT NULL');
        $this->addSql('ALTER TABLE "order" ALTER shipping SET NOT NULL');
        $this->addSql('ALTER TABLE "order" ALTER total SET NOT NULL');
        $this->addSql('ALTER TABLE "order" ALTER discount SET NOT NULL');
        $this->addSql('ALTER TABLE "order" ALTER grand_total SET NOT NULL');
        $this->addSql('ALTER TABLE "order" ALTER middle_name SET NOT NULL');
        $this->addSql('ALTER TABLE "order" ALTER email SET NOT NULL');
        $this->addSql('ALTER TABLE "order" ALTER line2 SET NOT NULL');
        $this->addSql('ALTER TABLE "order" ALTER content SET NOT NULL');
    }
}
