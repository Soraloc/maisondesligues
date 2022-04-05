<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220405104601 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE choixcreation');
        $this->addSql('ALTER TABLE liaisonateliertheme DROP FOREIGN KEY FK_168309E659027487');
        $this->addSql('ALTER TABLE liaisonateliertheme DROP FOREIGN KEY FK_168309E682E2CF35');
        $this->addSql('DROP INDEX IDX_168309E659027487 ON liaisonateliertheme');
        $this->addSql('DROP INDEX IDX_168309E682E2CF35 ON liaisonateliertheme');
        $this->addSql('ALTER TABLE liaisonateliertheme DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE liaisonateliertheme ADD idatelier INT NOT NULL, ADD idtheme INT NOT NULL, DROP atelier_id, DROP theme_id');
        $this->addSql('ALTER TABLE liaisonateliertheme ADD CONSTRAINT FK_168309E63EBF4A4D FOREIGN KEY (idatelier) REFERENCES atelier (id)');
        $this->addSql('ALTER TABLE liaisonateliertheme ADD CONSTRAINT FK_168309E641708B11 FOREIGN KEY (idtheme) REFERENCES theme (id)');
        $this->addSql('CREATE INDEX IDX_168309E63EBF4A4D ON liaisonateliertheme (idatelier)');
        $this->addSql('CREATE INDEX IDX_168309E641708B11 ON liaisonateliertheme (idtheme)');
        $this->addSql('ALTER TABLE liaisonateliertheme ADD PRIMARY KEY (idatelier, idtheme)');
        $this->addSql('ALTER TABLE categoriechambre ADD libellecategorie VARCHAR(50) NOT NULL, DROP libelle_categorie');
        $this->addSql('ALTER TABLE hotel CHANGE pnom pnom VARCHAR(40) NOT NULL, CHANGE cp cp CHAR(5) NOT NULL, CHANGE tel tel CHAR(14) NOT NULL, CHANGE mail mail VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE proposer ADD tarifnuitee NUMERIC(5, 2) NOT NULL, DROP tarif_nuite');
        $this->addSql('ALTER TABLE restauration ADD typerepas VARCHAR(30) NOT NULL, DROP type_repas, CHANGE date_restauration daterestauration DATE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE choixcreation (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(15) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE atelier CHANGE libelle libelle VARCHAR(40) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE categoriechambre ADD libelle_categorie VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP libellecategorie');
        $this->addSql('ALTER TABLE club CHANGE nom nom VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adresse1 adresse1 VARCHAR(60) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adresse2 adresse2 VARCHAR(60) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE cp cp CHAR(5) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ville ville VARCHAR(60) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE tel tel CHAR(14) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE hotel CHANGE pnom pnom VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adresse1 adresse1 VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adresse2 adresse2 VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE cp cp INT NOT NULL, CHANGE ville ville VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE tel tel INT NOT NULL, CHANGE mail mail VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE liaisonateliertheme DROP FOREIGN KEY FK_168309E63EBF4A4D');
        $this->addSql('ALTER TABLE liaisonateliertheme DROP FOREIGN KEY FK_168309E641708B11');
        $this->addSql('DROP INDEX IDX_168309E63EBF4A4D ON liaisonateliertheme');
        $this->addSql('DROP INDEX IDX_168309E641708B11 ON liaisonateliertheme');
        $this->addSql('ALTER TABLE liaisonateliertheme DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE liaisonateliertheme ADD atelier_id INT NOT NULL, ADD theme_id INT NOT NULL, DROP idatelier, DROP idtheme');
        $this->addSql('ALTER TABLE liaisonateliertheme ADD CONSTRAINT FK_168309E659027487 FOREIGN KEY (theme_id) REFERENCES theme (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE liaisonateliertheme ADD CONSTRAINT FK_168309E682E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_168309E659027487 ON liaisonateliertheme (theme_id)');
        $this->addSql('CREATE INDEX IDX_168309E682E2CF35 ON liaisonateliertheme (atelier_id)');
        $this->addSql('ALTER TABLE liaisonateliertheme ADD PRIMARY KEY (atelier_id, theme_id)');
        $this->addSql('ALTER TABLE licencie CHANGE nom nom VARCHAR(70) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE prenom prenom VARCHAR(70) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adresse1 adresse1 VARCHAR(60) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adresse2 adresse2 VARCHAR(60) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE cp cp CHAR(5) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ville ville VARCHAR(60) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE tel tel CHAR(14) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE mail mail VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE proposer ADD tarif_nuite INT NOT NULL, DROP tarifnuitee');
        $this->addSql('ALTER TABLE qualite CHANGE libellequalite libellequalite VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE restauration ADD type_repas VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP typerepas, CHANGE daterestauration date_restauration DATE NOT NULL');
        $this->addSql('ALTER TABLE theme CHANGE libelle libelle VARCHAR(40) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
