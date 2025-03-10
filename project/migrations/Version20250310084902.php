<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250310084902 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE timetable ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD professor_morning VARCHAR(255) NOT NULL, ADD subject_afternoon VARCHAR(255) NOT NULL, ADD professor_afternoon VARCHAR(255) NOT NULL, CHANGE thumbnail_name subject_morning VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE timetable ADD thumbnail_name VARCHAR(255) NOT NULL, DROP created_at, DROP subject_morning, DROP professor_morning, DROP subject_afternoon, DROP professor_afternoon');
    }
}
