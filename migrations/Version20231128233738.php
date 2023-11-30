<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231128233738 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE administrateur (id_admin INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, date_nais DATE DEFAULT NULL, email VARCHAR(50) NOT NULL, login VARCHAR(50) NOT NULL, tel VARCHAR(10) DEFAULT NULL, mdp VARCHAR(100) NOT NULL, PRIMARY KEY(id_admin)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE allergene (id_allergene INT AUTO_INCREMENT NOT NULL, nom_allergene VARCHAR(50) NOT NULL, description_allergene VARCHAR(500) NOT NULL, PRIMARY KEY(id_allergene)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etape (id_etape INT AUTO_INCREMENT NOT NULL, id_ingredient_id INT NOT NULL, id_recette_id INT NOT NULL, numero_etape INT DEFAULT NULL, description_etape VARCHAR(500) DEFAULT NULL, INDEX IDX_285F75DD2D1731E9 (id_ingredient_id), INDEX IDX_285F75DD2CBBAF3E (id_recette_id), PRIMARY KEY(id_etape)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient (id_ingredient INT AUTO_INCREMENT NOT NULL, id_allergene_id INT NOT NULL, nom_ingredient VARCHAR(50) NOT NULL, calories INT NOT NULL, unite_mesure VARCHAR(50) NOT NULL, description_ingredient VARCHAR(500) NOT NULL, INDEX IDX_6BAF787027A51FC0 (id_allergene_id), PRIMARY KEY(id_ingredient)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recette (id_recette INT AUTO_INCREMENT NOT NULL, id_admin_id INT NOT NULL, id_util_id INT NOT NULL, nom_recette VARCHAR(50) DEFAULT NULL, type_recette VARCHAR(50) DEFAULT NULL, niv_difficulte VARCHAR(50) DEFAULT NULL, description_recette VARCHAR(500) DEFAULT NULL, nb_personne INT DEFAULT NULL, duree VARCHAR(10) DEFAULT NULL, INDEX IDX_49BB639034F06E85 (id_admin_id), INDEX IDX_49BB639011C087F0 (id_util_id), PRIMARY KEY(id_recette)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detail_recette_ingredient (id_detail INT AUTO_INCREMENT NOT NULL, id_recette_id INT NOT NULL, id_ingredient_id INT NOT NULL, quantile INT NOT NULL, INDEX IDX_329D696A2CBBAF3E (id_recette_id), INDEX IDX_329D696A2D1731E9 (id_ingredient_id), PRIMARY KEY(id_detail)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id_util INT AUTO_INCREMENT NOT NULL, id_allergene_id INT NOT NULL, id_admin_id INT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, date_nais DATE NOT NULL, email VARCHAR(50) NOT NULL, login VARCHAR(50) NOT NULL, tel VARCHAR(10) NOT NULL, mdp VARCHAR(100) NOT NULL, INDEX IDX_1D1C63B327A51FC0 (id_allergene_id), INDEX IDX_1D1C63B334F06E85 (id_admin_id), PRIMARY KEY(id_util)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE detail_recette_ingredient ADD CONSTRAINT FK_329D696A2CBBAF3E FOREIGN KEY (id_recette_id) REFERENCES recette (id_recette)');
        $this->addSql('ALTER TABLE detail_recette_ingredient ADD CONSTRAINT FK_329D696A2D1731E9 FOREIGN KEY (id_ingredient_id) REFERENCES ingredient (id_ingredient)');
        $this->addSql('ALTER TABLE etape ADD CONSTRAINT FK_285F75DD2D1731E9 FOREIGN KEY (id_ingredient_id) REFERENCES ingredient (id_ingredient)');
        $this->addSql('ALTER TABLE etape ADD CONSTRAINT FK_285F75DD2CBBAF3E FOREIGN KEY (id_recette_id) REFERENCES recette (id_recette)');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF787027A51FC0 FOREIGN KEY (id_allergene_id) REFERENCES allergene (id_allergene)');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB639034F06E85 FOREIGN KEY (id_admin_id) REFERENCES administrateur (id_admin)');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB639011C087F0 FOREIGN KEY (id_util_id) REFERENCES utilisateur (id_util)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B327A51FC0 FOREIGN KEY (id_allergene_id) REFERENCES allergene (id_allergene)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B334F06E85 FOREIGN KEY (id_admin_id) REFERENCES administrateur (id_admin)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detail_recette_ingredient DROP FOREIGN KEY FK_329D696A2CBBAF3E');
        $this->addSql('ALTER TABLE detail_recette_ingredient DROP FOREIGN KEY FK_329D696A2D1731E9');
        $this->addSql('ALTER TABLE etape DROP FOREIGN KEY FK_285F75DD2D1731E9');
        $this->addSql('ALTER TABLE etape DROP FOREIGN KEY FK_285F75DD2CBBAF3E');
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF787027A51FC0');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB639034F06E85');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB639011C087F0');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B327A51FC0');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B334F06E85');
        $this->addSql('DROP TABLE administrateur');
        $this->addSql('DROP TABLE allergene');
        $this->addSql('DROP TABLE detail_recette_ingredient');
        $this->addSql('DROP TABLE etape');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE recette');
        $this->addSql('DROP TABLE utilisateur');
    }
}
