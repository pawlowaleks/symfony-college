<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210812073620 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE subject DROP FOREIGN KEY FK_FBCE3E7AB2513C1D');
        $this->addSql('DROP INDEX IDX_FBCE3E7AB2513C1D ON subject');
        $this->addSql('ALTER TABLE subject CHANGE parent_subject_id_id parent_subject_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE subject ADD CONSTRAINT FK_FBCE3E7A457D58D7 FOREIGN KEY (parent_subject_id) REFERENCES subject (id)');
        $this->addSql('CREATE INDEX IDX_FBCE3E7A457D58D7 ON subject (parent_subject_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE subject DROP FOREIGN KEY FK_FBCE3E7A457D58D7');
        $this->addSql('DROP INDEX IDX_FBCE3E7A457D58D7 ON subject');
        $this->addSql('ALTER TABLE subject CHANGE parent_subject_id parent_subject_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE subject ADD CONSTRAINT FK_FBCE3E7AB2513C1D FOREIGN KEY (parent_subject_id_id) REFERENCES subject (id)');
        $this->addSql('CREATE INDEX IDX_FBCE3E7AB2513C1D ON subject (parent_subject_id_id)');
    }
}
