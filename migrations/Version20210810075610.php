<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210810075610 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE college_major (college_id INT NOT NULL, major_id INT NOT NULL, INDEX IDX_64045D57770124B2 (college_id), INDEX IDX_64045D57E93695C7 (major_id), PRIMARY KEY(college_id, major_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE major (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, parent_major_id INT DEFAULT NULL, value VARCHAR(255) NOT NULL, INDEX title_idx (title), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE college_major ADD CONSTRAINT FK_64045D57770124B2 FOREIGN KEY (college_id) REFERENCES college (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE college_major ADD CONSTRAINT FK_64045D57E93695C7 FOREIGN KEY (major_id) REFERENCES major (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE college_major DROP FOREIGN KEY FK_64045D57E93695C7');
        $this->addSql('DROP TABLE college_major');
        $this->addSql('DROP TABLE major');
    }
}
