<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210810085353 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE major CHANGE parent_major_id parent_major_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE major ADD CONSTRAINT FK_3D34FD095A01BCAA FOREIGN KEY (parent_major_id_id) REFERENCES major (id)');
        $this->addSql('CREATE INDEX IDX_3D34FD095A01BCAA ON major (parent_major_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE major DROP FOREIGN KEY FK_3D34FD095A01BCAA');
        $this->addSql('DROP INDEX IDX_3D34FD095A01BCAA ON major');
        $this->addSql('ALTER TABLE major CHANGE parent_major_id_id parent_major_id INT DEFAULT NULL');
    }
}
