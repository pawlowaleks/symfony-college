<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210823071558 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE college_campus_life (id INT AUTO_INCREMENT NOT NULL, college_id INT DEFAULT NULL, overview VARCHAR(255) DEFAULT NULL, undergrads_living_on_campus INT DEFAULT NULL, help_finding_off_campus_housing TINYINT(1) DEFAULT NULL, quality_of_life_rating INT DEFAULT NULL, first_year_students_living_on_campus INT DEFAULT NULL, campus_environment VARCHAR(255) DEFAULT NULL, fire_safety_rating INT DEFAULT NULL, housing_options LONGTEXT DEFAULT NULL, college_entrance_tests_required TINYINT(1) DEFAULT NULL, interview_required TINYINT(1) DEFAULT NULL, special_need_services_offered LONGTEXT DEFAULT NULL, registered_student_organizations INT DEFAULT NULL, number_of_honor_societies INT DEFAULT NULL, number_of_social_sororities INT DEFAULT NULL, number_of_religious_organizations INT DEFAULT NULL, athletic_division VARCHAR(255) DEFAULT NULL, men_sports LONGTEXT DEFAULT NULL, women_sports LONGTEXT DEFAULT NULL, student_services LONGTEXT DEFAULT NULL, sustainability LONGTEXT DEFAULT NULL, green_rating INT DEFAULT NULL, campus_security_report LONGTEXT DEFAULT NULL, campus_wide_internet_network TINYINT(1) DEFAULT NULL, percent_of_classrooms_with_wireless_internet SMALLINT DEFAULT NULL, fee_for_network_use TINYINT(1) DEFAULT NULL, partnerships_with_technology_companies TINYINT(1) DEFAULT NULL, personal_computer_included_in_tuition_for_each_student TINYINT(1) DEFAULT NULL, discounts_available_with_hardware_vendors TINYINT(1) DEFAULT NULL, hardware_vendors_description VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_F921FB6C770124B2 (college_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE college_campus_life ADD CONSTRAINT FK_F921FB6C770124B2 FOREIGN KEY (college_id) REFERENCES college (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE college_campus_life');
    }
}
