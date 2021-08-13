<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210813094126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE subject_course (subject_id INT NOT NULL, course_id INT NOT NULL, INDEX IDX_9E87A69E23EDC87 (subject_id), INDEX IDX_9E87A69E591CC992 (course_id), PRIMARY KEY(subject_id, course_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE subject_course ADD CONSTRAINT FK_9E87A69E23EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subject_course ADD CONSTRAINT FK_9E87A69E591CC992 FOREIGN KEY (course_id) REFERENCES course (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX title_idx ON subject (title)');
        $this->addSql('CREATE INDEX title_idx ON tag (title)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE subject_course');
        $this->addSql('DROP INDEX title_idx ON subject');
        $this->addSql('DROP INDEX title_idx ON tag');
    }
}
