<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221207163557 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profil ADD color_r INT NOT NULL, ADD color_g INT NOT NULL, ADD color_b INT NOT NULL, ADD color_rq INT NOT NULL, ADD color_gq INT NOT NULL, ADD color_bq INT NOT NULL, ADD color_rp INT NOT NULL, ADD color_gp INT NOT NULL, ADD color_bp INT NOT NULL, ADD color_rv INT NOT NULL, ADD color_gv INT NOT NULL, ADD color_bv INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profil DROP color_r, DROP color_g, DROP color_b, DROP color_rq, DROP color_gq, DROP color_bq, DROP color_rp, DROP color_gp, DROP color_bp, DROP color_rv, DROP color_gv, DROP color_bv');
    }
}
