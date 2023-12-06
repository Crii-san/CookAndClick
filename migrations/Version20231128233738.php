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
        $this->addSql('CREATE TABLE allergene (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, description VARCHAR(500) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etape (id INT AUTO_INCREMENT NOT NULL, id_ingredient_id INT NOT NULL, id_recette_id INT NOT NULL, numero INT DEFAULT NULL, description VARCHAR(500) DEFAULT NULL, INDEX IDX_285F75DD2D1731E9 (id_ingredient_id), INDEX IDX_285F75DD2CBBAF3E (id_recette_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, id_allergene_id INT NOT NULL, nom VARCHAR(50) NOT NULL, calories INT NOT NULL, unite_mesure VARCHAR(50) NOT NULL, description VARCHAR(500) NOT NULL, INDEX IDX_6BAF787027A51FC0 (id_allergene_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recette (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) DEFAULT NULL, type VARCHAR(50) DEFAULT NULL, niv_difficulte VARCHAR(50) DEFAULT NULL, description VARCHAR(500) DEFAULT NULL, nb_personne INT DEFAULT NULL, duree VARCHAR(10) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, dateNais DATE DEFAULT NULL, pseudo VARCHAR(50) DEFAULT NULL, tel VARCHAR(10) DEFAULT NULL, id_allergene_id INT NOT NULL, PRIMARY KEY(id), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D64927A51FC0 (id_allergene_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etape_ingredient (etape_id INT NOT NULL, ingredient_id INT NOT NULL, INDEX IDX_5B37942C4A8CA2AD (etape_id), INDEX IDX_5B37942C933FE08C (ingredient_id), PRIMARY KEY(etape_id, ingredient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient_allergene (ingredient_id INT NOT NULL, allergene_id INT NOT NULL, INDEX IDX_99518292933FE08C (ingredient_id), INDEX IDX_995182924646AB2 (allergene_id), PRIMARY KEY(ingredient_id, allergene_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE etape ADD CONSTRAINT FK_285F75DD2D1731E9 FOREIGN KEY (id_ingredient_id) REFERENCES ingredient (id)');
        $this->addSql('ALTER TABLE etape ADD CONSTRAINT FK_285F75DD2CBBAF3E FOREIGN KEY (id_recette_id) REFERENCES recette (id)');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF787027A51FC0 FOREIGN KEY (id_allergene_id) REFERENCES allergene (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64927A51FC0 FOREIGN KEY (id_allergene_id) REFERENCES allergene (id)');
        $this->addSql('ALTER TABLE etape_ingredient ADD CONSTRAINT FK_5B37942C4A8CA2AD FOREIGN KEY (etape_id) REFERENCES etape (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etape_ingredient ADD CONSTRAINT FK_5B37942C933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredient_allergene ADD CONSTRAINT FK_99518292933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredient_allergene ADD CONSTRAINT FK_995182924646AB2 FOREIGN KEY (allergene_id) REFERENCES allergene (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etape_ingredient DROP FOREIGN KEY FK_5B37942C4A8CA2AD');
        $this->addSql('ALTER TABLE etape_ingredient DROP FOREIGN KEY FK_5B37942C933FE08C');
        $this->addSql('ALTER TABLE ingredient_allergene DROP FOREIGN KEY FK_99518292933FE08C');
        $this->addSql('ALTER TABLE ingredient_allergene DROP FOREIGN KEY FK_995182924646AB2');
        $this->addSql('ALTER TABLE etape DROP FOREIGN KEY FK_285F75DD2D1731E9');
        $this->addSql('ALTER TABLE etape DROP FOREIGN KEY FK_285F75DD2CBBAF3E');
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF787027A51FC0');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB639034F06E85');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB639011C087F0');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64927A51FC0');
        $this->addSql('DROP TABLE etape_ingredient');
        $this->addSql('DROP TABLE ingredient_allergene');
        $this->addSql('DROP TABLE allergene');
        $this->addSql('DROP TABLE etape');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE recette');
    }
}
