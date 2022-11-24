<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221115181203 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE profil_value (id INT AUTO_INCREMENT NOT NULL, critery_id INT NOT NULL, profil_id INT NOT NULL, value DOUBLE PRECISION DEFAULT NULL, INDEX IDX_537B83708490AD8C (critery_id), INDEX IDX_537B8370275ED078 (profil_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE profil_value ADD CONSTRAINT FK_537B83708490AD8C FOREIGN KEY (critery_id) REFERENCES critery (id)');
        $this->addSql('ALTER TABLE profil_value ADD CONSTRAINT FK_537B8370275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profil_value DROP FOREIGN KEY FK_537B83708490AD8C');
        $this->addSql('ALTER TABLE profil_value DROP FOREIGN KEY FK_537B8370275ED078');
        $this->addSql('DROP TABLE profil_value');
    }
}
