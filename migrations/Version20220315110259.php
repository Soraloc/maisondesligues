<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220315110259 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE club (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, adresse1 VARCHAR(60) NOT NULL, adresse2 VARCHAR(60) DEFAULT NULL, cp VARCHAR(5) NOT NULL, ville VARCHAR(60) NOT NULL, tel VARCHAR(14) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE licencie (id INT AUTO_INCREMENT NOT NULL, le_club_id INT NOT NULL, la_qualite_id INT NOT NULL, num_licence NUMERIC(11, 0) NOT NULL, nom VARCHAR(70) NOT NULL, prenom VARCHAR(70) NOT NULL, adresse1 VARCHAR(60) NOT NULL, adresse2 VARCHAR(60) DEFAULT NULL, cp VARCHAR(5) NOT NULL, ville VARCHAR(60) NOT NULL, tel VARCHAR(14) NOT NULL, mail VARCHAR(100) NOT NULL, date_adhesion DATE NOT NULL, INDEX IDX_3B7556124ED67C45 (le_club_id), INDEX IDX_3B7556128635C1A4 (la_qualite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE qualite (id INT AUTO_INCREMENT NOT NULL, libelle_qualite VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE licencie ADD CONSTRAINT FK_3B7556124ED67C45 FOREIGN KEY (le_club_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE licencie ADD CONSTRAINT FK_3B7556128635C1A4 FOREIGN KEY (la_qualite_id) REFERENCES qualite (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE licencie DROP FOREIGN KEY FK_3B7556124ED67C45');
        $this->addSql('ALTER TABLE licencie DROP FOREIGN KEY FK_3B7556128635C1A4');
        $this->addSql('DROP TABLE club');
        $this->addSql('DROP TABLE licencie');
        $this->addSql('DROP TABLE qualite');
    }
}
