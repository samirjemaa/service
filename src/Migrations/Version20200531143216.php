<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200531143216 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE personne (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, tel VARCHAR(255) NOT NULL, urlimage VARCHAR(255) DEFAULT NULL, urlfb VARCHAR(255) DEFAULT NULL, anciennete INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne_specialite (personne_id INT NOT NULL, specialite_id INT NOT NULL, INDEX IDX_1DDFB4C5A21BD112 (personne_id), INDEX IDX_1DDFB4C52195E0F0 (specialite_id), PRIMARY KEY(personne_id, specialite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secteur (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialite (id INT AUTO_INCREMENT NOT NULL, secteur_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_E7D6FCC19F7E4405 (secteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE personne_specialite ADD CONSTRAINT FK_1DDFB4C5A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personne_specialite ADD CONSTRAINT FK_1DDFB4C52195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE specialite ADD CONSTRAINT FK_E7D6FCC19F7E4405 FOREIGN KEY (secteur_id) REFERENCES secteur (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE personne_specialite DROP FOREIGN KEY FK_1DDFB4C5A21BD112');
        $this->addSql('ALTER TABLE specialite DROP FOREIGN KEY FK_E7D6FCC19F7E4405');
        $this->addSql('ALTER TABLE personne_specialite DROP FOREIGN KEY FK_1DDFB4C52195E0F0');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP TABLE personne_specialite');
        $this->addSql('DROP TABLE secteur');
        $this->addSql('DROP TABLE specialite');
    }
}
