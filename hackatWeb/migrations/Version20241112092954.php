<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241112092954 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, un_utilisateur_id INT DEFAULT NULL, un_hackaton_id INT DEFAULT NULL, date_inscription DATE NOT NULL, INDEX IDX_5E90F6D6B0141749 (un_utilisateur_id), INDEX IDX_5E90F6D6DD39DACB (un_hackaton_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6B0141749 FOREIGN KEY (un_utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6DD39DACB FOREIGN KEY (un_hackaton_id) REFERENCES hackaton (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6B0141749');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6DD39DACB');
        $this->addSql('DROP TABLE inscription');
    }
}
