<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221114181125 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE klas_name (id INT AUTO_INCREMENT NOT NULL, project_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_DA287F1D166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE klas_name ADD CONSTRAINT FK_DA287F1D166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE critery ADD alfa_q DOUBLE PRECISION DEFAULT NULL, ADD beta_q DOUBLE PRECISION DEFAULT NULL, ADD alfa_p DOUBLE PRECISION DEFAULT NULL, ADD beta_p DOUBLE PRECISION DEFAULT NULL, ADD alfa_v DOUBLE PRECISION DEFAULT NULL, ADD beta_v DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE klas_name DROP FOREIGN KEY FK_DA287F1D166D1F9C');
        $this->addSql('DROP TABLE klas_name');
        $this->addSql('ALTER TABLE critery DROP alfa_q, DROP beta_q, DROP alfa_p, DROP beta_p, DROP alfa_v, DROP beta_v');
    }
}
