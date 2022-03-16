<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220315110800 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE licencie DROP FOREIGN KEY FK_3B7556124ED67C45');
        $this->addSql('ALTER TABLE licencie DROP FOREIGN KEY FK_3B7556128635C1A4');
        $this->addSql('DROP INDEX IDX_3B7556128635C1A4 ON licencie');
        $this->addSql('DROP INDEX IDX_3B7556124ED67C45 ON licencie');
        $this->addSql('ALTER TABLE licencie ADD idclub INT NOT NULL, ADD idqualite INT NOT NULL, DROP le_club_id, DROP la_qualite_id, CHANGE num_licence numlicence NUMERIC(11, 0) NOT NULL, CHANGE date_adhesion dateadhesion DATE NOT NULL');
        $this->addSql('ALTER TABLE licencie ADD CONSTRAINT FK_3B7556126B21C9D2 FOREIGN KEY (idclub) REFERENCES club (id)');
        $this->addSql('ALTER TABLE licencie ADD CONSTRAINT FK_3B755612B7B70531 FOREIGN KEY (idqualite) REFERENCES qualite (id)');
        $this->addSql('CREATE INDEX IDX_3B7556126B21C9D2 ON licencie (idclub)');
        $this->addSql('CREATE INDEX IDX_3B755612B7B70531 ON licencie (idqualite)');
        $this->addSql('ALTER TABLE qualite CHANGE libelle_qualite libellequalite VARCHAR(50) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE club CHANGE nom nom VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adresse1 adresse1 VARCHAR(60) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adresse2 adresse2 VARCHAR(60) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE cp cp VARCHAR(5) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ville ville VARCHAR(60) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE tel tel VARCHAR(14) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE licencie DROP FOREIGN KEY FK_3B7556126B21C9D2');
        $this->addSql('ALTER TABLE licencie DROP FOREIGN KEY FK_3B755612B7B70531');
        $this->addSql('DROP INDEX IDX_3B7556126B21C9D2 ON licencie');
        $this->addSql('DROP INDEX IDX_3B755612B7B70531 ON licencie');
        $this->addSql('ALTER TABLE licencie ADD le_club_id INT NOT NULL, ADD la_qualite_id INT NOT NULL, DROP idclub, DROP idqualite, CHANGE nom nom VARCHAR(70) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE prenom prenom VARCHAR(70) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adresse1 adresse1 VARCHAR(60) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adresse2 adresse2 VARCHAR(60) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE cp cp VARCHAR(5) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ville ville VARCHAR(60) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE tel tel VARCHAR(14) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE mail mail VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE numlicence num_licence NUMERIC(11, 0) NOT NULL, CHANGE dateadhesion date_adhesion DATE NOT NULL');
        $this->addSql('ALTER TABLE licencie ADD CONSTRAINT FK_3B7556124ED67C45 FOREIGN KEY (le_club_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE licencie ADD CONSTRAINT FK_3B7556128635C1A4 FOREIGN KEY (la_qualite_id) REFERENCES qualite (id)');
        $this->addSql('CREATE INDEX IDX_3B7556128635C1A4 ON licencie (la_qualite_id)');
        $this->addSql('CREATE INDEX IDX_3B7556124ED67C45 ON licencie (le_club_id)');
        $this->addSql('ALTER TABLE qualite ADD libelle_qualite VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP libellequalite');
    }
}
