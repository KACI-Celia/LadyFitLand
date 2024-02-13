<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240213222200 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE salle_de_sport ADD adresse_salle VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user DROP statut_user, CHANGE nom_user nom_user VARCHAR(100) DEFAULT NULL, CHANGE prenom_user prenom_user VARCHAR(100) DEFAULT NULL, CHANGE tel_user tel_user INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE salle_de_sport DROP adresse_salle');
        $this->addSql('ALTER TABLE user ADD statut_user VARCHAR(100) DEFAULT NULL, CHANGE nom_user nom_user VARCHAR(100) NOT NULL, CHANGE prenom_user prenom_user VARCHAR(100) NOT NULL, CHANGE tel_user tel_user DOUBLE PRECISION DEFAULT NULL');
    }
}
