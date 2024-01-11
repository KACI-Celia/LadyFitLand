<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240110144648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD email VARCHAR(180) NOT NULL, ADD roles JSON NOT NULL, ADD password VARCHAR(255) NOT NULL, DROP email_user, DROP mot_de_pass_user, CHANGE nom_user nom_user VARCHAR(100) DEFAULT NULL, CHANGE prenom_user prenom_user VARCHAR(100) DEFAULT NULL, CHANGE tel_user tel_user DOUBLE PRECISION DEFAULT NULL, CHANGE statut_user statut_user VARCHAR(100) DEFAULT NULL, CHANGE adresse_user adresse_user VARCHAR(255) DEFAULT NULL, CHANGE type_abonnement adresse_facturation_user VARCHAR(255) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user ADD email_user VARCHAR(70) DEFAULT NULL, ADD mot_de_pass_user VARCHAR(50) DEFAULT NULL, DROP email, DROP roles, DROP password, CHANGE nom_user nom_user VARCHAR(70) DEFAULT NULL, CHANGE prenom_user prenom_user VARCHAR(70) DEFAULT NULL, CHANGE tel_user tel_user VARCHAR(14) DEFAULT NULL, CHANGE adresse_user adresse_user VARCHAR(255) NOT NULL, CHANGE statut_user statut_user VARCHAR(255) DEFAULT NULL, CHANGE adresse_facturation_user type_abonnement VARCHAR(255) DEFAULT NULL');
    }
}
