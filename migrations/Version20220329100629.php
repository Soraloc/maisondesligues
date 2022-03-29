<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220329100629 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE proposer ADD un_hotel_id INT NOT NULL');
        $this->addSql('ALTER TABLE proposer ADD CONSTRAINT FK_21866C15D1569148 FOREIGN KEY (un_hotel_id) REFERENCES hotel (id)');
        $this->addSql('CREATE INDEX IDX_21866C15D1569148 ON proposer (un_hotel_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorieChambre CHANGE libellecategorie libellecategorie VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE club CHANGE nom nom VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adresse1 adresse1 VARCHAR(60) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adresse2 adresse2 VARCHAR(60) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE cp cp CHAR(5) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ville ville VARCHAR(60) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE tel tel CHAR(14) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE hotel CHANGE pnom pnom VARCHAR(40) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adresse1 adresse1 VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adresse2 adresse2 VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE cp cp CHAR(5) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ville ville VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE tel tel CHAR(14) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE mail mail VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE licencie CHANGE nom nom VARCHAR(70) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE prenom prenom VARCHAR(70) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adresse1 adresse1 VARCHAR(60) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adresse2 adresse2 VARCHAR(60) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE cp cp CHAR(5) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ville ville VARCHAR(60) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE tel tel CHAR(14) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE mail mail VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE proposer DROP FOREIGN KEY FK_21866C15D1569148');
        $this->addSql('DROP INDEX IDX_21866C15D1569148 ON proposer');
        $this->addSql('ALTER TABLE proposer DROP un_hotel_id');
        $this->addSql('ALTER TABLE qualite CHANGE libellequalite libellequalite VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE restauration CHANGE typerepas typerepas VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
