<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210816112449 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE college_admissions (id INT AUTO_INCREMENT NOT NULL, college_id INT DEFAULT NULL, applicants INT DEFAULT NULL, acceptansce_rate SMALLINT DEFAULT NULL, average_hsgpa DOUBLE PRECISION DEFAULT NULL, gpa_breakdown LONGTEXT DEFAULT NULL, test_scores LONGTEXT DEFAULT NULL, deadlines LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_8A9B7A5770124B2 (college_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE college_admissions ADD CONSTRAINT FK_8A9B7A5770124B2 FOREIGN KEY (college_id) REFERENCES college (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE college_admissions');
    }
}
