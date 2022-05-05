<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220505134906 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE liaisonateliertheme (atelier_id INT NOT NULL, theme_id INT NOT NULL, INDEX IDX_168309E682E2CF35 (atelier_id), INDEX IDX_168309E659027487 (theme_id), PRIMARY KEY(atelier_id, theme_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categoriechambre (id INT AUTO_INCREMENT NOT NULL, libellecategorie VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nuitee (id INT AUTO_INCREMENT NOT NULL, datenuitee DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE liaisonateliertheme ADD CONSTRAINT FK_168309E682E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE liaisonateliertheme ADD CONSTRAINT FK_168309E659027487 FOREIGN KEY (theme_id) REFERENCES theme (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE atelier_theme');
        $this->addSql('DROP TABLE categorie_chambre');
        $this->addSql('DROP TABLE nuite');
        $this->addSql('ALTER TABLE compte ADD mail_valide TINYINT(1) DEFAULT 0 NOT NULL, CHANGE identifiant identifiant VARCHAR(70) NOT NULL');
        $this->addSql('ALTER TABLE hotel CHANGE pnom pnom VARCHAR(40) NOT NULL, CHANGE cp cp CHAR(5) NOT NULL, CHANGE tel tel CHAR(14) NOT NULL, CHANGE mail mail VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE proposer ADD tarifnuitee NUMERIC(5, 2) NOT NULL, DROP tarif_nuite');
        $this->addSql('ALTER TABLE restauration ADD typerepas VARCHAR(30) NOT NULL, DROP type_repas, CHANGE date_restauration daterestauration DATE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE atelier_theme (atelier_id INT NOT NULL, theme_id INT NOT NULL, INDEX IDX_AEB6D34382E2CF35 (atelier_id), INDEX IDX_AEB6D34359027487 (theme_id), PRIMARY KEY(atelier_id, theme_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE categorie_chambre (id INT AUTO_INCREMENT NOT NULL, libelle_categorie VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE nuite (id INT AUTO_INCREMENT NOT NULL, date_nuitee DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE atelier_theme ADD CONSTRAINT FK_AEB6D34359027487 FOREIGN KEY (theme_id) REFERENCES theme (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE atelier_theme ADD CONSTRAINT FK_AEB6D34382E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE liaisonateliertheme');
        $this->addSql('DROP TABLE categoriechambre');
        $this->addSql('DROP TABLE nuitee');
        $this->addSql('ALTER TABLE compte DROP mail_valide, CHANGE identifiant identifiant VARCHAR(180) NOT NULL');
        $this->addSql('ALTER TABLE hotel CHANGE pnom pnom VARCHAR(255) NOT NULL, CHANGE cp cp INT NOT NULL, CHANGE tel tel INT NOT NULL, CHANGE mail mail VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE proposer ADD tarif_nuite INT NOT NULL, DROP tarifnuitee');
        $this->addSql('ALTER TABLE restauration ADD type_repas VARCHAR(255) NOT NULL, DROP typerepas, CHANGE daterestauration date_restauration DATE NOT NULL');
    }
}
