<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250311135127 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE coach (id INT AUTO_INCREMENT NOT NULL, nom_coach VARCHAR(255) NOT NULL, lien_linkedin VARCHAR(255) DEFAULT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coach_motivant_specialite (coach_motivant_id INT NOT NULL, specialite_id INT NOT NULL, INDEX IDX_531326658155999D (coach_motivant_id), INDEX IDX_531326652195E0F0 (specialite_id), PRIMARY KEY(coach_motivant_id, specialite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coach_metier_competence_metier (coach_metier_id INT NOT NULL, competence_metier_id INT NOT NULL, INDEX IDX_2101ADE7B67EEB7 (coach_metier_id), INDEX IDX_2101ADED9A38C5D (competence_metier_id), PRIMARY KEY(coach_metier_id, competence_metier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coach_technique_competence_technique (coach_technique_id INT NOT NULL, competence_technique_id INT NOT NULL, INDEX IDX_F8C1EB6BEE7AF33A (coach_technique_id), INDEX IDX_F8C1EB6B81CDA962 (competence_technique_id), PRIMARY KEY(coach_technique_id, competence_technique_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competence_metier (id INT AUTO_INCREMENT NOT NULL, libelle_metier VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competence_technique (id INT AUTO_INCREMENT NOT NULL, libelle_technique VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialite (id INT AUTO_INCREMENT NOT NULL, libelle_motivant VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE coach_motivant_specialite ADD CONSTRAINT FK_531326658155999D FOREIGN KEY (coach_motivant_id) REFERENCES coach (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coach_motivant_specialite ADD CONSTRAINT FK_531326652195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coach_metier_competence_metier ADD CONSTRAINT FK_2101ADE7B67EEB7 FOREIGN KEY (coach_metier_id) REFERENCES coach (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coach_metier_competence_metier ADD CONSTRAINT FK_2101ADED9A38C5D FOREIGN KEY (competence_metier_id) REFERENCES competence_metier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coach_technique_competence_technique ADD CONSTRAINT FK_F8C1EB6BEE7AF33A FOREIGN KEY (coach_technique_id) REFERENCES coach (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coach_technique_competence_technique ADD CONSTRAINT FK_F8C1EB6B81CDA962 FOREIGN KEY (competence_technique_id) REFERENCES competence_technique (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY fk_id_hack_event');
        $this->addSql('ALTER TABLE event_atelier DROP FOREIGN KEY event_fk');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY fk_atelier_avis');
        $this->addSql('ALTER TABLE event_conference DROP FOREIGN KEY event_conf_fk');
        $this->addSql('ALTER TABLE participer DROP FOREIGN KEY FK_participer_utilisateur');
        $this->addSql('ALTER TABLE participer DROP FOREIGN KEY FK_participer_event_atelier');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_atelier');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE event_conference');
        $this->addSql('DROP TABLE participer');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, id_hack INT NOT NULL, date_event DATE DEFAULT NULL, heure_event VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, duree_event INT DEFAULT NULL, nom_salle VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, INDEX fk_id_hack_event (id_hack), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE event_atelier (id INT NOT NULL, nb_participants INT DEFAULT NULL, INDEX event_fk (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE avis (id_commentaire INT AUTO_INCREMENT NOT NULL, id_event_atelier INT DEFAULT NULL, avis_utilisateur VARCHAR(500) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, email_utilisateur VARCHAR(500) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, INDEX fk_atelier_avis (id_event_atelier), PRIMARY KEY(id_commentaire)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE event_conference (id INT NOT NULL, theme VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, intervenant VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, INDEX event_conf_fk (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE participer (id_util INT NOT NULL, id_event INT NOT NULL, INDEX I_FK_participer_utilisateur (id_util), INDEX I_FK_participer_event_atelier (id_event), PRIMARY KEY(id_util, id_event)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT fk_id_hack_event FOREIGN KEY (id_hack) REFERENCES hackaton (id)');
        $this->addSql('ALTER TABLE event_atelier ADD CONSTRAINT event_fk FOREIGN KEY (id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT fk_atelier_avis FOREIGN KEY (id_event_atelier) REFERENCES event_atelier (id)');
        $this->addSql('ALTER TABLE event_conference ADD CONSTRAINT event_conf_fk FOREIGN KEY (id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE participer ADD CONSTRAINT FK_participer_utilisateur FOREIGN KEY (id_util) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE participer ADD CONSTRAINT FK_participer_event_atelier FOREIGN KEY (id_event) REFERENCES event_atelier (id)');
        $this->addSql('ALTER TABLE coach_motivant_specialite DROP FOREIGN KEY FK_531326658155999D');
        $this->addSql('ALTER TABLE coach_motivant_specialite DROP FOREIGN KEY FK_531326652195E0F0');
        $this->addSql('ALTER TABLE coach_metier_competence_metier DROP FOREIGN KEY FK_2101ADE7B67EEB7');
        $this->addSql('ALTER TABLE coach_metier_competence_metier DROP FOREIGN KEY FK_2101ADED9A38C5D');
        $this->addSql('ALTER TABLE coach_technique_competence_technique DROP FOREIGN KEY FK_F8C1EB6BEE7AF33A');
        $this->addSql('ALTER TABLE coach_technique_competence_technique DROP FOREIGN KEY FK_F8C1EB6B81CDA962');
        $this->addSql('DROP TABLE coach');
        $this->addSql('DROP TABLE coach_motivant_specialite');
        $this->addSql('DROP TABLE coach_metier_competence_metier');
        $this->addSql('DROP TABLE coach_technique_competence_technique');
        $this->addSql('DROP TABLE competence_metier');
        $this->addSql('DROP TABLE competence_technique');
        $this->addSql('DROP TABLE specialite');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
