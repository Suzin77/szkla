<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210218190649 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact_department (contact_id INT NOT NULL, department_id INT NOT NULL, INDEX IDX_AA4B81DE7A1254A (contact_id), INDEX IDX_AA4B81DAE80F5DF (department_id), PRIMARY KEY(contact_id, department_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contact_department ADD CONSTRAINT FK_AA4B81DE7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contact_department ADD CONSTRAINT FK_AA4B81DAE80F5DF FOREIGN KEY (department_id) REFERENCES department (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE department_contact');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE department_contact (department_id INT NOT NULL, contact_id INT NOT NULL, INDEX IDX_F1CB0EDBAE80F5DF (department_id), INDEX IDX_F1CB0EDBE7A1254A (contact_id), PRIMARY KEY(department_id, contact_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE department_contact ADD CONSTRAINT FK_F1CB0EDBAE80F5DF FOREIGN KEY (department_id) REFERENCES department (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE department_contact ADD CONSTRAINT FK_F1CB0EDBE7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE contact_department');
    }
}
