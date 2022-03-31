<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220331081823 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE liaisonateliertheme ADD PRIMARY KEY (idatelier, idtheme)');
        $this->addSql('ALTER TABLE liaisonateliertheme ADD CONSTRAINT FK_168309E63EBF4A4D FOREIGN KEY (idatelier) REFERENCES atelier (id)');
        $this->addSql('ALTER TABLE liaisonateliertheme ADD CONSTRAINT FK_168309E641708B11 FOREIGN KEY (idtheme) REFERENCES theme (id)');
        $this->addSql('CREATE INDEX IDX_168309E63EBF4A4D ON liaisonateliertheme (idatelier)');
        $this->addSql('CREATE INDEX IDX_168309E641708B11 ON liaisonateliertheme (idtheme)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE atelier CHANGE libelle libelle VARCHAR(40) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE categoriechambre CHANGE libellecategorie libellecategorie VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE club CHANGE nom nom VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adresse1 adresse1 VARCHAR(60) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adresse2 adresse2 VARCHAR(60) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE cp cp CHAR(5) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ville ville VARCHAR(60) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE tel tel CHAR(14) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE hotel CHANGE pnom pnom VARCHAR(40) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adresse1 adresse1 VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adresse2 adresse2 VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE cp cp CHAR(5) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ville ville VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE tel tel CHAR(14) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE mail mail VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE liaisonateliertheme DROP FOREIGN KEY FK_168309E63EBF4A4D');
        $this->addSql('ALTER TABLE liaisonateliertheme DROP FOREIGN KEY FK_168309E641708B11');
        $this->addSql('DROP INDEX IDX_168309E63EBF4A4D ON liaisonateliertheme');
        $this->addSql('DROP INDEX IDX_168309E641708B11 ON liaisonateliertheme');
        $this->addSql('ALTER TABLE liaisonateliertheme DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE licencie CHANGE nom nom VARCHAR(70) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE prenom prenom VARCHAR(70) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adresse1 adresse1 VARCHAR(60) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adresse2 adresse2 VARCHAR(60) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE cp cp CHAR(5) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ville ville VARCHAR(60) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE tel tel CHAR(14) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE mail mail VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE qualite CHANGE libellequalite libellequalite VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE restauration CHANGE typerepas typerepas VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE theme CHANGE libelle libelle VARCHAR(40) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
