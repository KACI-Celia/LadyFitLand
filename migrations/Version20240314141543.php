<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240314141543 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE abonnement (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(70) DEFAULT NULL, prix DOUBLE PRECISION DEFAULT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE configuration (id INT AUTO_INCREMENT NOT NULL, nom_salle VARCHAR(255) NOT NULL, tel_salle VARCHAR(255) NOT NULL, email_salle VARCHAR(255) NOT NULL, adresse_salle VARCHAR(255) NOT NULL, heure_ouverture TIME NOT NULL COMMENT \'(DC2Type:time_immutable)\', heure_fermeture TIME NOT NULL COMMENT \'(DC2Type:time_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, espaces_id INT DEFAULT NULL, lib_cours VARCHAR(70) DEFAULT NULL, date_debut VARCHAR(10) DEFAULT NULL, date_fin VARCHAR(10) DEFAULT NULL, heure_debut VARCHAR(8) DEFAULT NULL, heure_fin VARCHAR(8) DEFAULT NULL, quantite_participant VARCHAR(50) DEFAULT NULL, coach VARCHAR(250) DEFAULT NULL, instructions LONGTEXT DEFAULT NULL, INDEX IDX_FDCA8C9CA3C3180A (espaces_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipements (id INT AUTO_INCREMENT NOT NULL, libelle_equipement VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE espaces (id INT AUTO_INCREMENT NOT NULL, libelle_espace VARCHAR(255) DEFAULT NULL, description_espace LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE idees (id INT AUTO_INCREMENT NOT NULL, libelleidee LONGTEXT DEFAULT NULL, commentaire LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, abonnement_id INT DEFAULT NULL, roles JSON NOT NULL, is_verified TINYINT(1) NOT NULL, reset_token VARCHAR(100) NOT NULL, nom_user VARCHAR(100) DEFAULT NULL, prenom_user VARCHAR(100) DEFAULT NULL, date_naissance_user DATE DEFAULT NULL, adresse_user VARCHAR(255) DEFAULT NULL, zipcode VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, adresse_facturation_user VARCHAR(255) DEFAULT NULL, tel_user INT DEFAULT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649F1D74413 (abonnement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_cours (user_id INT NOT NULL, cours_id INT NOT NULL, INDEX IDX_1F0877C4A76ED395 (user_id), INDEX IDX_1F0877C47ECF78B0 (cours_id), PRIMARY KEY(user_id, cours_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_idees (user_id INT NOT NULL, idees_id INT NOT NULL, INDEX IDX_9B1CCF82A76ED395 (user_id), INDEX IDX_9B1CCF823C1E798B (idees_id), PRIMARY KEY(user_id, idees_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_espaces (user_id INT NOT NULL, espaces_id INT NOT NULL, INDEX IDX_700667EDA76ED395 (user_id), INDEX IDX_700667EDA3C3180A (espaces_id), PRIMARY KEY(user_id, espaces_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CA3C3180A FOREIGN KEY (espaces_id) REFERENCES espaces (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F1D74413 FOREIGN KEY (abonnement_id) REFERENCES abonnement (id)');
        $this->addSql('ALTER TABLE user_cours ADD CONSTRAINT FK_1F0877C4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_cours ADD CONSTRAINT FK_1F0877C47ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_idees ADD CONSTRAINT FK_9B1CCF82A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_idees ADD CONSTRAINT FK_9B1CCF823C1E798B FOREIGN KEY (idees_id) REFERENCES idees (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_espaces ADD CONSTRAINT FK_700667EDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_espaces ADD CONSTRAINT FK_700667EDA3C3180A FOREIGN KEY (espaces_id) REFERENCES espaces (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CA3C3180A');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F1D74413');
        $this->addSql('ALTER TABLE user_cours DROP FOREIGN KEY FK_1F0877C4A76ED395');
        $this->addSql('ALTER TABLE user_cours DROP FOREIGN KEY FK_1F0877C47ECF78B0');
        $this->addSql('ALTER TABLE user_idees DROP FOREIGN KEY FK_9B1CCF82A76ED395');
        $this->addSql('ALTER TABLE user_idees DROP FOREIGN KEY FK_9B1CCF823C1E798B');
        $this->addSql('ALTER TABLE user_espaces DROP FOREIGN KEY FK_700667EDA76ED395');
        $this->addSql('ALTER TABLE user_espaces DROP FOREIGN KEY FK_700667EDA3C3180A');
        $this->addSql('DROP TABLE abonnement');
        $this->addSql('DROP TABLE configuration');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE equipements');
        $this->addSql('DROP TABLE espaces');
        $this->addSql('DROP TABLE idees');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_cours');
        $this->addSql('DROP TABLE user_idees');
        $this->addSql('DROP TABLE user_espaces');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
