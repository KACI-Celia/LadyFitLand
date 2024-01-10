<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231231173715 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, lib_cours VARCHAR(70) DEFAULT NULL, date_debut VARCHAR(10) DEFAULT NULL, date_fin VARCHAR(10) DEFAULT NULL, heure_debut VARCHAR(8) DEFAULT NULL, heure_fin VARCHAR(8) DEFAULT NULL, quantite_participant VARCHAR(50) DEFAULT NULL, coach VARCHAR(250) DEFAULT NULL, instructions LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nom_user VARCHAR(70) DEFAULT NULL, prenom_user VARCHAR(70) DEFAULT NULL, email_user VARCHAR(70) DEFAULT NULL, tel_user VARCHAR(14) DEFAULT NULL, date_naissance_user DATE DEFAULT NULL, mot_de_pass_user VARCHAR(50) DEFAULT NULL, type_abonnement VARCHAR(255) DEFAULT NULL, statut_user VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE user');
    }
}
