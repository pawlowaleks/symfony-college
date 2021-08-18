<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210818103205 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE college_careers (id INT AUTO_INCREMENT NOT NULL, college_id INT DEFAULT NULL, graduate_in4_years INT DEFAULT NULL, graduate_in5_years INT DEFAULT NULL, graduate_in6_years INT DEFAULT NULL, on_campus_job_interviews_available TINYINT(1) DEFAULT NULL, career_services LONGTEXT DEFAULT NULL, starting_median_salary_up_to_bachelors_degree_completed_only INT DEFAULT NULL, mid_career_median_salary_upto_bachelors_degree_completed_only INT DEFAULT NULL, starting_median_salary_at_least_bachelors_degree INT DEFAULT NULL, mid_career_median_salary_at_least_bachelors_degree INT DEFAULT NULL, percent_high_job_meaning SMALLINT DEFAULT NULL, percent_stem SMALLINT DEFAULT NULL, roi_rating SMALLINT DEFAULT NULL, UNIQUE INDEX UNIQ_387595C770124B2 (college_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE college_careers ADD CONSTRAINT FK_387595C770124B2 FOREIGN KEY (college_id) REFERENCES college (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE college_careers');
    }
}
