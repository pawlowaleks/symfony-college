<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210812073423 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE course (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, overview LONGTEXT NOT NULL, url VARCHAR(255) NOT NULL, taugh_by VARCHAR(255) DEFAULT NULL, language VARCHAR(255) DEFAULT NULL, duration VARCHAR(255) DEFAULT NULL, duration_hours INT DEFAULT NULL, level SMALLINT DEFAULT NULL, subtitles VARCHAR(255) DEFAULT NULL, trailer_image_url VARCHAR(255) DEFAULT NULL, start_date DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subject (id INT AUTO_INCREMENT NOT NULL, parent_subject_id_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_FBCE3E7AB2513C1D (parent_subject_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE subject ADD CONSTRAINT FK_FBCE3E7AB2513C1D FOREIGN KEY (parent_subject_id_id) REFERENCES subject (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE subject DROP FOREIGN KEY FK_FBCE3E7AB2513C1D');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE subject');
    }
}
