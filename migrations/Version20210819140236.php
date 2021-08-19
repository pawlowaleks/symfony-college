<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210819140236 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE college_tuition (id INT AUTO_INCREMENT NOT NULL, college_id INT DEFAULT NULL, application_deadlines VARCHAR(255) DEFAULT NULL, notification_date VARCHAR(255) DEFAULT NULL, required_forms LONGTEXT DEFAULT NULL, average_freshman_total_need_based_gift_aid INT DEFAULT NULL, average_undergraduate_total_need_based_gift_aid INT DEFAULT NULL, average_need_based_loan INT DEFAULT NULL, undergraduates_who_have_borrowed_through_any_loan_program INT DEFAULT NULL, average_amount_of_loan_debt_per_graduate INT DEFAULT NULL, average_amount_of_each_freshman_scholarship_grant_package INT DEFAULT NULL, financial_aid_provided_to_international_students TINYINT(1) DEFAULT NULL, tuition_in_state INT DEFAULT NULL, tuition_out_of_state INT DEFAULT NULL, required_fees INT DEFAULT NULL, average_cost_for_books_and_supplies INT DEFAULT NULL, tuition_fees_vary_by_year_of_study TINYINT(1) DEFAULT NULL, board_for_commuters INT DEFAULT NULL, transportation_for_commuters INT DEFAULT NULL, on_campus_room_and_board INT DEFAULT NULL, financial_aid_methodology VARCHAR(255) DEFAULT NULL, scholarships_and_grants_need_based VARCHAR(255) DEFAULT NULL, scholarships_and_grants_non_need_based VARCHAR(255) DEFAULT NULL, federal_direct_student_loan_programs VARCHAR(255) DEFAULT NULL, federal_family_education_loan_programs VARCHAR(255) DEFAULT NULL, is_institutional_employment_available TINYINT(1) DEFAULT NULL, direct_lender TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_535CD459770124B2 (college_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE college_tuition ADD CONSTRAINT FK_535CD459770124B2 FOREIGN KEY (college_id) REFERENCES college (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE college_tuition');
    }
}
