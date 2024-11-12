<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241107110047 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE hackaton (id INT AUTO_INCREMENT NOT NULL, nb_places_hack INT NOT NULL, date_limite_hack DATE NOT NULL, theme_hack VARCHAR(255) NOT NULL, date_debut_hack DATE NOT NULL, date_fin_hack DATE NOT NULL, heure_debut_hack VARCHAR(255) NOT NULL, heure_fin_hack VARCHAR(255) NOT NULL, ville_hack VARCHAR(255) NOT NULL, cp_hack VARCHAR(255) NOT NULL, rue_hack VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE hackaton');
    }
}
