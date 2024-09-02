<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240902140832 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE biblio_biomasse (id INT AUTO_INCREMENT NOT NULL, biomasse VARCHAR(255) NOT NULL, chemin VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE biblio_elevateur (id INT AUTO_INCREMENT NOT NULL, gamme VARCHAR(255) NOT NULL, debit VARCHAR(255) NOT NULL, chemin VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE biblio_grille (id INT AUTO_INCREMENT NOT NULL, grille VARCHAR(255) NOT NULL, chemin VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE biblio_module (id INT AUTO_INCREMENT NOT NULL, module VARCHAR(255) NOT NULL, chemin VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE biblio_reprise (id INT AUTO_INCREMENT NOT NULL, reprise VARCHAR(255) NOT NULL, debit VARCHAR(255) NOT NULL, chemin VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE biblio_tc_fosse (id INT AUTO_INCREMENT NOT NULL, gamme VARCHAR(255) NOT NULL, debit VARCHAR(255) NOT NULL, transporteur VARCHAR(255) NOT NULL, chemin VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE biblio_tremie (id INT AUTO_INCREMENT NOT NULL, tremie VARCHAR(255) NOT NULL, gamme VARCHAR(255) NOT NULL, transporteur VARCHAR(255) NOT NULL, largeur INT NOT NULL, debit VARCHAR(255) NOT NULL, chemin VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE biblio_vis_mobile (id INT AUTO_INCREMENT NOT NULL, vis VARCHAR(255) NOT NULL, chemin VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, id_client VARCHAR(255) DEFAULT NULL, raison_sociale VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, mobile VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE demande_commerciale (id INT AUTO_INCREMENT NOT NULL, stockage_id INT DEFAULT NULL, secheuse_id INT DEFAULT NULL, sechoir_id INT DEFAULT NULL, nettoyeur_id INT DEFAULT NULL, manutention_id INT DEFAULT NULL, client_id INT DEFAULT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', type_demande VARCHAR(255) NOT NULL, INDEX IDX_7FE5F832DAA83D7F (stockage_id), INDEX IDX_7FE5F832F4823279 (secheuse_id), INDEX IDX_7FE5F8323B8BEB5A (sechoir_id), INDEX IDX_7FE5F83288DE56B4 (nettoyeur_id), INDEX IDX_7FE5F832359F416D (manutention_id), INDEX IDX_7FE5F83219EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE manutention (id INT AUTO_INCREMENT NOT NULL, gamme VARCHAR(255) NOT NULL, debit_alimentation INT NOT NULL, debit_reprise INT NOT NULL, type_vanne VARCHAR(255) DEFAULT NULL, prenettoyeur VARCHAR(255) DEFAULT NULL, type_bd VARCHAR(255) DEFAULT NULL, type_grille VARCHAR(255) DEFAULT NULL, type_tremie VARCHAR(255) DEFAULT NULL, type_transporteur VARCHAR(255) DEFAULT NULL, capot_fosse VARCHAR(255) DEFAULT NULL, capot_puit VARCHAR(255) DEFAULT NULL, type_expedition VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nettoyeur (id INT AUTO_INCREMENT NOT NULL, modele VARCHAR(255) NOT NULL, grille INT NOT NULL, dechet_leger VARCHAR(255) NOT NULL, dechet_mi_lourds VARCHAR(255) NOT NULL, dechet_sortie_r VARCHAR(255) NOT NULL, sortie_bon_grain VARCHAR(255) NOT NULL, type_reprise_nettoyeur VARCHAR(255) NOT NULL, structure VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secheuse (id INT AUTO_INCREMENT NOT NULL, type_secheuse INT NOT NULL, type_plancher VARCHAR(255) NOT NULL, type_reprise VARCHAR(255) NOT NULL, debit_reprise VARCHAR(255) NOT NULL, type_module INT DEFAULT NULL, gaz VARCHAR(255) DEFAULT NULL, biomasse VARCHAR(255) DEFAULT NULL, vis_brassage VARCHAR(255) DEFAULT NULL, prenettoyeur VARCHAR(255) DEFAULT NULL, b2d VARCHAR(255) DEFAULT NULL, vis_mobile VARCHAR(255) DEFAULT NULL, quantite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sechoir (id INT AUTO_INCREMENT NOT NULL, tremie VARCHAR(255) NOT NULL, modele VARCHAR(255) NOT NULL, energie VARCHAR(255) NOT NULL, charpente VARCHAR(255) NOT NULL, acces_exterieur VARCHAR(255) NOT NULL, acces_interieur VARCHAR(255) NOT NULL, option_volet VARCHAR(255) NOT NULL, option_vigi_incendie VARCHAR(255) NOT NULL, option_grande_porte VARCHAR(255) NOT NULL, option_lot_electrique VARCHAR(255) NOT NULL, option_nettoyeur VARCHAR(255) NOT NULL, option_filtration VARCHAR(255) NOT NULL, type_tampon VARCHAR(255) DEFAULT NULL, diametre_tampon INT DEFAULT NULL, pente_cone INT DEFAULT NULL, virole_tampon INT DEFAULT NULL, trappe_sortie VARCHAR(255) DEFAULT NULL, type_reprise VARCHAR(255) DEFAULT NULL, debit_reprise VARCHAR(255) DEFAULT NULL, option_toit VARCHAR(255) DEFAULT NULL, sonde_niveau VARCHAR(255) DEFAULT NULL, thermometrie VARCHAR(255) DEFAULT NULL, quantite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stockage (id INT AUTO_INCREMENT NOT NULL, type_cellule VARCHAR(255) NOT NULL, diametre_cellule INT NOT NULL, virole_cellule INT NOT NULL, type_plancher VARCHAR(255) NOT NULL, type_reprise VARCHAR(255) NOT NULL, debit_reprise VARCHAR(255) NOT NULL, option_toit VARCHAR(255) DEFAULT NULL, option_porte VARCHAR(255) NOT NULL, sonde_niveau VARCHAR(255) DEFAULT NULL, thermometrie VARCHAR(255) DEFAULT NULL, ventilateur VARCHAR(255) NOT NULL, acces_mur VARCHAR(255) DEFAULT NULL, acces_toit VARCHAR(255) DEFAULT NULL, bac_entre_cellule VARCHAR(255) DEFAULT NULL, plateforme_toit VARCHAR(255) DEFAULT NULL, passerelle VARCHAR(255) DEFAULT NULL, vis_mobile VARCHAR(255) DEFAULT NULL, quantite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE demande_commerciale ADD CONSTRAINT FK_7FE5F832DAA83D7F FOREIGN KEY (stockage_id) REFERENCES stockage (id)');
        $this->addSql('ALTER TABLE demande_commerciale ADD CONSTRAINT FK_7FE5F832F4823279 FOREIGN KEY (secheuse_id) REFERENCES secheuse (id)');
        $this->addSql('ALTER TABLE demande_commerciale ADD CONSTRAINT FK_7FE5F8323B8BEB5A FOREIGN KEY (sechoir_id) REFERENCES sechoir (id)');
        $this->addSql('ALTER TABLE demande_commerciale ADD CONSTRAINT FK_7FE5F83288DE56B4 FOREIGN KEY (nettoyeur_id) REFERENCES nettoyeur (id)');
        $this->addSql('ALTER TABLE demande_commerciale ADD CONSTRAINT FK_7FE5F832359F416D FOREIGN KEY (manutention_id) REFERENCES manutention (id)');
        $this->addSql('ALTER TABLE demande_commerciale ADD CONSTRAINT FK_7FE5F83219EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_commerciale DROP FOREIGN KEY FK_7FE5F832DAA83D7F');
        $this->addSql('ALTER TABLE demande_commerciale DROP FOREIGN KEY FK_7FE5F832F4823279');
        $this->addSql('ALTER TABLE demande_commerciale DROP FOREIGN KEY FK_7FE5F8323B8BEB5A');
        $this->addSql('ALTER TABLE demande_commerciale DROP FOREIGN KEY FK_7FE5F83288DE56B4');
        $this->addSql('ALTER TABLE demande_commerciale DROP FOREIGN KEY FK_7FE5F832359F416D');
        $this->addSql('ALTER TABLE demande_commerciale DROP FOREIGN KEY FK_7FE5F83219EB6921');
        $this->addSql('DROP TABLE biblio_biomasse');
        $this->addSql('DROP TABLE biblio_elevateur');
        $this->addSql('DROP TABLE biblio_grille');
        $this->addSql('DROP TABLE biblio_module');
        $this->addSql('DROP TABLE biblio_reprise');
        $this->addSql('DROP TABLE biblio_tc_fosse');
        $this->addSql('DROP TABLE biblio_tremie');
        $this->addSql('DROP TABLE biblio_vis_mobile');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE demande_commerciale');
        $this->addSql('DROP TABLE manutention');
        $this->addSql('DROP TABLE nettoyeur');
        $this->addSql('DROP TABLE secheuse');
        $this->addSql('DROP TABLE sechoir');
        $this->addSql('DROP TABLE stockage');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
