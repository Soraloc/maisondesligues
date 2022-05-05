<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220406143219 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE atelier (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(40) NOT NULL, nbplacesmaxi INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categoriechambre (id INT AUTO_INCREMENT NOT NULL, libellecategorie VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE club (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, adresse1 VARCHAR(60) NOT NULL, adresse2 VARCHAR(60) DEFAULT NULL, cp CHAR(5) NOT NULL, ville VARCHAR(60) NOT NULL, tel CHAR(14) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hotel (id INT AUTO_INCREMENT NOT NULL, pnom VARCHAR(40) NOT NULL, adresse1 VARCHAR(255) NOT NULL, adresse2 VARCHAR(255) DEFAULT NULL, cp CHAR(5) NOT NULL, ville VARCHAR(255) NOT NULL, tel CHAR(14) NOT NULL, mail VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, date_inscription DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE licencie (id INT AUTO_INCREMENT NOT NULL, idclub INT NOT NULL, idqualite INT NOT NULL, numlicence NUMERIC(11, 0) NOT NULL, nom VARCHAR(70) NOT NULL, prenom VARCHAR(70) NOT NULL, adresse1 VARCHAR(60) NOT NULL, adresse2 VARCHAR(60) DEFAULT NULL, cp CHAR(5) NOT NULL, ville VARCHAR(60) NOT NULL, tel CHAR(14) NOT NULL, mail VARCHAR(100) NOT NULL, dateadhesion DATE NOT NULL, INDEX IDX_3B7556126B21C9D2 (idclub), INDEX IDX_3B755612B7B70531 (idqualite), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nuitee (id INT AUTO_INCREMENT NOT NULL, datenuitee DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proposer (id INT AUTO_INCREMENT NOT NULL, hotelid INT NOT NULL, tarifnuitee NUMERIC(5, 2) NOT NULL, INDEX IDX_21866C15631066A6 (hotelid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE qualite (id INT AUTO_INCREMENT NOT NULL, libellequalite VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restauration (id INT AUTO_INCREMENT NOT NULL, daterestauration DATE NOT NULL, typerepas VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theme (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vacation (id INT AUTO_INCREMENT NOT NULL, idatelier INT NOT NULL, dateheuredebut DATETIME NOT NULL, dateheurefin DATETIME NOT NULL, INDEX IDX_E3DADF753EBF4A4D (idatelier), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE licencie ADD CONSTRAINT FK_3B7556126B21C9D2 FOREIGN KEY (idclub) REFERENCES club (id)');
        $this->addSql('ALTER TABLE licencie ADD CONSTRAINT FK_3B755612B7B70531 FOREIGN KEY (idqualite) REFERENCES qualite (id)');
        $this->addSql('ALTER TABLE proposer ADD CONSTRAINT FK_21866C15631066A6 FOREIGN KEY (hotelid) REFERENCES hotel (id)');
        $this->addSql('ALTER TABLE vacation ADD CONSTRAINT FK_E3DADF753EBF4A4D FOREIGN KEY (idatelier) REFERENCES atelier (id)');
        $this->addSql('ALTER TABLE liaisonateliertheme ADD CONSTRAINT FK_168309E682E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE liaisonateliertheme ADD CONSTRAINT FK_168309E659027487 FOREIGN KEY (theme_id) REFERENCES theme (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE liaisonateliertheme DROP FOREIGN KEY FK_168309E682E2CF35');
        $this->addSql('ALTER TABLE vacation DROP FOREIGN KEY FK_E3DADF753EBF4A4D');
        $this->addSql('ALTER TABLE licencie DROP FOREIGN KEY FK_3B7556126B21C9D2');
        $this->addSql('ALTER TABLE proposer DROP FOREIGN KEY FK_21866C15631066A6');
        $this->addSql('ALTER TABLE licencie DROP FOREIGN KEY FK_3B755612B7B70531');
        $this->addSql('ALTER TABLE liaisonateliertheme DROP FOREIGN KEY FK_168309E659027487');
        $this->addSql('DROP TABLE atelier');
        $this->addSql('DROP TABLE categoriechambre');
        $this->addSql('DROP TABLE club');
        $this->addSql('DROP TABLE hotel');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE licencie');
        $this->addSql('DROP TABLE nuitee');
        $this->addSql('DROP TABLE proposer');
        $this->addSql('DROP TABLE qualite');
        $this->addSql('DROP TABLE restauration');
        $this->addSql('DROP TABLE theme');
        $this->addSql('DROP TABLE vacation');
    }
}
