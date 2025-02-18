<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250218093227 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__enfant AS SELECT id, nom, prenom, date_de_naissance, email_parent_1, email_parent_2 FROM enfant');
        $this->addSql('DROP TABLE enfant');
        $this->addSql('CREATE TABLE enfant (id VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_de_naissance DATE NOT NULL --(DC2Type:date_immutable)
        , email_parent_1 VARCHAR(255) DEFAULT NULL, email_parent_2 VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO enfant (id, nom, prenom, date_de_naissance, email_parent_1, email_parent_2) SELECT id, nom, prenom, date_de_naissance, email_parent_1, email_parent_2 FROM __temp__enfant');
        $this->addSql('DROP TABLE __temp__enfant');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER ON enfant (nom, prenom, date_de_naissance)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__enfant AS SELECT id, nom, prenom, date_de_naissance, email_parent_1, email_parent_2 FROM enfant');
        $this->addSql('DROP TABLE enfant');
        $this->addSql('CREATE TABLE enfant (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_de_naissance DATE NOT NULL --(DC2Type:date_immutable)
        , email_parent_1 VARCHAR(255) DEFAULT NULL, email_parent_2 VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO enfant (id, nom, prenom, date_de_naissance, email_parent_1, email_parent_2) SELECT id, nom, prenom, date_de_naissance, email_parent_1, email_parent_2 FROM __temp__enfant');
        $this->addSql('DROP TABLE __temp__enfant');
    }
}
