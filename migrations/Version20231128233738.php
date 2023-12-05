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
        $this->addSql('CREATE TABLE allergene (id_allergene INT AUTO_INCREMENT NOT NULL, nom_allergene VARCHAR(50) NOT NULL, description_allergene VARCHAR(500) NOT NULL, PRIMARY KEY(id_allergene)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etape (id_etape INT AUTO_INCREMENT NOT NULL, id_ingredient_id INT NOT NULL, id_recette_id INT NOT NULL, numero_etape INT DEFAULT NULL, description_etape VARCHAR(500) DEFAULT NULL, INDEX IDX_285F75DD2D1731E9 (id_ingredient_id), INDEX IDX_285F75DD2CBBAF3E (id_recette_id), PRIMARY KEY(id_etape)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient (id_ingredient INT AUTO_INCREMENT NOT NULL, id_allergene_id INT NOT NULL, nom_ingredient VARCHAR(50) NOT NULL, calories INT NOT NULL, unite_mesure VARCHAR(50) NOT NULL, description_ingredient VARCHAR(500) NOT NULL, INDEX IDX_6BAF787027A51FC0 (id_allergene_id), PRIMARY KEY(id_ingredient)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recette (id_recette INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, nom_recette VARCHAR(50) DEFAULT NULL, type_recette VARCHAR(50) DEFAULT NULL, niv_difficulte VARCHAR(50) DEFAULT NULL, description_recette VARCHAR(500) DEFAULT NULL, nb_personne INT DEFAULT NULL, duree VARCHAR(10) DEFAULT NULL, INDEX IDX_49BB639034F06E85 (id_user_id), PRIMARY KEY(id_recette)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detail_recette_ingredient (id_detail INT AUTO_INCREMENT NOT NULL, id_recette_id INT NOT NULL, id_ingredient_id INT NOT NULL, quantite INT NOT NULL, INDEX IDX_329D696A2CBBAF3E (id_recette_id), INDEX IDX_329D696A2D1731E9 (id_ingredient_id), PRIMARY KEY(id_detail)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id_user INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, dateNais DATE DEFAULT NULL, pseudo VARCHAR(50) DEFAULT NULL, tel VARCHAR(10) DEFAULT NULL, id_allergene_id INT NOT NULL, PRIMARY KEY(id_user), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D64927A51FC0 (id_allergene_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE detail_recette_ingredient ADD CONSTRAINT FK_329D696A2CBBAF3E FOREIGN KEY (id_recette_id) REFERENCES recette (id_recette)');
        $this->addSql('ALTER TABLE detail_recette_ingredient ADD CONSTRAINT FK_329D696A2D1731E9 FOREIGN KEY (id_ingredient_id) REFERENCES ingredient (id_ingredient)');
        $this->addSql('ALTER TABLE etape ADD CONSTRAINT FK_285F75DD2D1731E9 FOREIGN KEY (id_ingredient_id) REFERENCES ingredient (id_ingredient)');
        $this->addSql('ALTER TABLE etape ADD CONSTRAINT FK_285F75DD2CBBAF3E FOREIGN KEY (id_recette_id) REFERENCES recette (id_recette)');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF787027A51FC0 FOREIGN KEY (id_allergene_id) REFERENCES allergene (id_allergene)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64927A51FC0 FOREIGN KEY (id_allergene_id) REFERENCES allergene (id_allergene)');
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
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64927A51FC0');
        $this->addSql('DROP TABLE allergene');
        $this->addSql('DROP TABLE detail_recette_ingredient');
        $this->addSql('DROP TABLE etape');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE recette');
    }
}
