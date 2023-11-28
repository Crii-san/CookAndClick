<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231128162949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE DetailRecetteIngredient DROP FOREIGN KEY FK_DETAILRE_CORRESPON_INGREDIE');
        $this->addSql('ALTER TABLE DetailRecetteIngredient DROP FOREIGN KEY FK_DETAILRE_UTILISER_RECETTE');
        $this->addSql('DROP TABLE DetailRecetteIngredient');
        $this->addSql('ALTER TABLE Administrateur ADD id_admin INT AUTO_INCREMENT NOT NULL, DROP idAdmin, CHANGE nom nom VARCHAR(50) NOT NULL, CHANGE prenom prenom VARCHAR(50) NOT NULL, CHANGE email email VARCHAR(50) NOT NULL, CHANGE login login VARCHAR(50) NOT NULL, CHANGE tel tel VARCHAR(10) DEFAULT NULL, CHANGE mdp mdp VARCHAR(100) NOT NULL, CHANGE dateNais date_nais DATE DEFAULT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id_admin)');
        $this->addSql('ALTER TABLE Allergene ADD id_allergene INT AUTO_INCREMENT NOT NULL, ADD nom_allergene VARCHAR(50) NOT NULL, ADD description_allergene VARCHAR(500) NOT NULL, DROP idAllergene, DROP nomAllergene, DROP descriptionAllergene, DROP PRIMARY KEY, ADD PRIMARY KEY (id_allergene)');
        $this->addSql('ALTER TABLE Etape DROP FOREIGN KEY FK_ETAPE_APPARTENI_RECETTE');
        $this->addSql('ALTER TABLE Etape DROP FOREIGN KEY FK_ETAPE_COMPOSER_INGREDIE');
        $this->addSql('DROP INDEX COMPOSER_FK ON Etape');
        $this->addSql('DROP INDEX APPARTENIR_FK ON Etape');
        $this->addSql('ALTER TABLE Etape ADD id_etape INT AUTO_INCREMENT NOT NULL, DROP idEtape, DROP idIngredient, DROP idRecette, CHANGE numeroEtape numero_etape INT DEFAULT NULL, CHANGE descriptionEtape description_etape VARCHAR(500) DEFAULT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id_etape)');
        $this->addSql('ALTER TABLE Ingredient DROP FOREIGN KEY FK_INGREDIE_POSSEDER_ALLERGEN');
        $this->addSql('DROP INDEX POSSEDER_FK ON Ingredient');
        $this->addSql('ALTER TABLE Ingredient ADD id_ingredient INT AUTO_INCREMENT NOT NULL, ADD nom_ingredient VARCHAR(50) NOT NULL, ADD unite_mesure VARCHAR(50) NOT NULL, ADD description_ingredient VARCHAR(500) NOT NULL, DROP idIngredient, DROP idAllergene, DROP nomIngredient, DROP uniteMesure, DROP descriprionIngredient, CHANGE calories calories INT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id_ingredient)');
        $this->addSql('ALTER TABLE Recette DROP FOREIGN KEY FK_RECETTE_GERER_ADMINIST');
        $this->addSql('ALTER TABLE Recette DROP FOREIGN KEY FK_RECETTE_PROPOSER_UTILISAT');
        $this->addSql('DROP INDEX GERER_FK ON Recette');
        $this->addSql('DROP INDEX PROPOSER_FK ON Recette');
        $this->addSql('ALTER TABLE Recette ADD id_recette INT AUTO_INCREMENT NOT NULL, ADD nom_recette VARCHAR(50) DEFAULT NULL, ADD type_recette VARCHAR(50) DEFAULT NULL, ADD niv_difficulte VARCHAR(50) DEFAULT NULL, DROP idRecette, DROP idAdmin, DROP idUtil, DROP nomRecette, DROP typeRecette, DROP nivDifficulte, CHANGE descriptionRecette description_recette VARCHAR(500) DEFAULT NULL, CHANGE nbPersonne nb_personne INT DEFAULT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id_recette)');
        $this->addSql('ALTER TABLE Utilisateur DROP FOREIGN KEY FK_UTILISAT_ADMINISTR_ADMINIST');
        $this->addSql('ALTER TABLE Utilisateur DROP FOREIGN KEY FK_UTILISAT_ETRE_ALLE_ALLERGEN');
        $this->addSql('DROP INDEX ADMINISTRE_FK ON Utilisateur');
        $this->addSql('DROP INDEX ETRE_ALLERGIQUE_FK ON Utilisateur');
        $this->addSql('ALTER TABLE Utilisateur ADD id_util INT AUTO_INCREMENT NOT NULL, ADD date_nais DATE NOT NULL, DROP idUtil, DROP idAllergene, DROP idAdmin, DROP dateNais, CHANGE nom nom VARCHAR(50) NOT NULL, CHANGE prenom prenom VARCHAR(50) NOT NULL, CHANGE email email VARCHAR(50) NOT NULL, CHANGE login login VARCHAR(50) NOT NULL, CHANGE tel tel VARCHAR(10) NOT NULL, CHANGE mdp mdp VARCHAR(100) NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id_util)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE DetailRecetteIngredient (idDetail INT NOT NULL, idRecette INT NOT NULL, idIngredient INT NOT NULL, quantite INT DEFAULT NULL, INDEX UTILISER_FK (idRecette), INDEX CORRESPONDRE_FK (idIngredient), PRIMARY KEY(idDetail)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE DetailRecetteIngredient ADD CONSTRAINT FK_DETAILRE_CORRESPON_INGREDIE FOREIGN KEY (idIngredient) REFERENCES Ingredient (idIngredient)');
        $this->addSql('ALTER TABLE DetailRecetteIngredient ADD CONSTRAINT FK_DETAILRE_UTILISER_RECETTE FOREIGN KEY (idRecette) REFERENCES Recette (idRecette)');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE administrateur MODIFY id_admin INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON administrateur');
        $this->addSql('ALTER TABLE administrateur ADD idAdmin INT NOT NULL, DROP id_admin, CHANGE nom nom VARCHAR(50) DEFAULT NULL, CHANGE prenom prenom VARCHAR(50) DEFAULT NULL, CHANGE email email VARCHAR(50) DEFAULT NULL, CHANGE login login VARCHAR(50) DEFAULT NULL, CHANGE tel tel CHAR(10) DEFAULT NULL, CHANGE mdp mdp VARCHAR(100) DEFAULT NULL, CHANGE date_nais dateNais DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE administrateur ADD PRIMARY KEY (idAdmin)');
        $this->addSql('ALTER TABLE allergene MODIFY id_allergene INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON allergene');
        $this->addSql('ALTER TABLE allergene ADD idAllergene INT NOT NULL, ADD nomAllergene VARCHAR(50) DEFAULT NULL, ADD descriptionAllergene VARCHAR(500) DEFAULT NULL, DROP id_allergene, DROP nom_allergene, DROP description_allergene');
        $this->addSql('ALTER TABLE allergene ADD PRIMARY KEY (idAllergene)');
        $this->addSql('ALTER TABLE etape MODIFY id_etape INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON etape');
        $this->addSql('ALTER TABLE etape ADD idEtape INT NOT NULL, ADD idIngredient INT NOT NULL, ADD idRecette INT NOT NULL, DROP id_etape, CHANGE numero_etape numeroEtape INT DEFAULT NULL, CHANGE description_etape descriptionEtape VARCHAR(500) DEFAULT NULL');
        $this->addSql('ALTER TABLE etape ADD CONSTRAINT FK_ETAPE_APPARTENI_RECETTE FOREIGN KEY (idRecette) REFERENCES Recette (idRecette)');
        $this->addSql('ALTER TABLE etape ADD CONSTRAINT FK_ETAPE_COMPOSER_INGREDIE FOREIGN KEY (idIngredient) REFERENCES Ingredient (idIngredient)');
        $this->addSql('CREATE INDEX COMPOSER_FK ON etape (idIngredient)');
        $this->addSql('CREATE INDEX APPARTENIR_FK ON etape (idRecette)');
        $this->addSql('ALTER TABLE etape ADD PRIMARY KEY (idEtape)');
        $this->addSql('ALTER TABLE ingredient MODIFY id_ingredient INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON ingredient');
        $this->addSql('ALTER TABLE ingredient ADD idIngredient INT NOT NULL, ADD idAllergene INT DEFAULT NULL, ADD nomIngredient VARCHAR(50) DEFAULT NULL, ADD uniteMesure VARCHAR(50) DEFAULT NULL, ADD descriprionIngredient VARCHAR(500) DEFAULT NULL, DROP id_ingredient, DROP nom_ingredient, DROP unite_mesure, DROP description_ingredient, CHANGE calories calories INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_INGREDIE_POSSEDER_ALLERGEN FOREIGN KEY (idAllergene) REFERENCES Allergene (idAllergene)');
        $this->addSql('CREATE INDEX POSSEDER_FK ON ingredient (idAllergene)');
        $this->addSql('ALTER TABLE ingredient ADD PRIMARY KEY (idIngredient)');
        $this->addSql('ALTER TABLE recette MODIFY id_recette INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON recette');
        $this->addSql('ALTER TABLE recette ADD idRecette INT NOT NULL, ADD idAdmin INT NOT NULL, ADD idUtil INT NOT NULL, ADD nomRecette VARCHAR(50) DEFAULT NULL, ADD typeRecette VARCHAR(50) DEFAULT NULL, ADD nivDifficulte VARCHAR(50) DEFAULT NULL, DROP id_recette, DROP nom_recette, DROP type_recette, DROP niv_difficulte, CHANGE description_recette descriptionRecette VARCHAR(500) DEFAULT NULL, CHANGE nb_personne nbPersonne INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_RECETTE_GERER_ADMINIST FOREIGN KEY (idAdmin) REFERENCES Administrateur (idAdmin)');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_RECETTE_PROPOSER_UTILISAT FOREIGN KEY (idUtil) REFERENCES Utilisateur (idUtil)');
        $this->addSql('CREATE INDEX GERER_FK ON recette (idAdmin)');
        $this->addSql('CREATE INDEX PROPOSER_FK ON recette (idUtil)');
        $this->addSql('ALTER TABLE recette ADD PRIMARY KEY (idRecette)');
        $this->addSql('ALTER TABLE utilisateur MODIFY id_util INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur ADD idUtil INT NOT NULL, ADD idAllergene INT DEFAULT NULL, ADD idAdmin INT NOT NULL, ADD dateNais DATE DEFAULT NULL, DROP id_util, DROP date_nais, CHANGE nom nom VARCHAR(50) DEFAULT NULL, CHANGE prenom prenom VARCHAR(50) DEFAULT NULL, CHANGE email email VARCHAR(50) DEFAULT NULL, CHANGE login login VARCHAR(50) DEFAULT NULL, CHANGE tel tel CHAR(10) DEFAULT NULL, CHANGE mdp mdp VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_UTILISAT_ADMINISTR_ADMINIST FOREIGN KEY (idAdmin) REFERENCES Administrateur (idAdmin)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_UTILISAT_ETRE_ALLE_ALLERGEN FOREIGN KEY (idAllergene) REFERENCES Allergene (idAllergene)');
        $this->addSql('CREATE INDEX ADMINISTRE_FK ON utilisateur (idAdmin)');
        $this->addSql('CREATE INDEX ETRE_ALLERGIQUE_FK ON utilisateur (idAllergene)');
        $this->addSql('ALTER TABLE utilisateur ADD PRIMARY KEY (idUtil)');
    }
}
