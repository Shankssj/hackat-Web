<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250318102107 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE favoris (utilisateur_id INT NOT NULL, hackaton_id INT NOT NULL, INDEX IDX_8933C432FB88E14F (utilisateur_id), INDEX IDX_8933C432B333DC5B (hackaton_id), PRIMARY KEY(utilisateur_id, hackaton_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_8933C432FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_8933C432B333DC5B FOREIGN KEY (hackaton_id) REFERENCES hackaton (id) ON DELETE CASCADE');
        
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, id_hack INT NOT NULL, date_event DATE DEFAULT NULL, heure_event VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, duree_event INT DEFAULT NULL, nom_salle VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, INDEX fk_id_hack_event (id_hack), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE coach (id INT AUTO_INCREMENT NOT NULL, nom_coach VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, lien_linkedin VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE event_atelier (id INT NOT NULL, nb_participants INT DEFAULT NULL, INDEX event_fk (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE competence_metier (id INT AUTO_INCREMENT NOT NULL, libelle_metier VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE coach_metier_competence_metier (coach_metier_id INT NOT NULL, competence_metier_id INT NOT NULL, INDEX IDX_2101ADED9A38C5D (competence_metier_id), INDEX IDX_2101ADE7B67EEB7 (coach_metier_id), PRIMARY KEY(coach_metier_id, competence_metier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE coach_technique_competence_technique (coach_technique_id INT NOT NULL, competence_technique_id INT NOT NULL, INDEX IDX_F8C1EB6B81CDA962 (competence_technique_id), INDEX IDX_F8C1EB6BEE7AF33A (coach_technique_id), PRIMARY KEY(coach_technique_id, competence_technique_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE competence_technique (id INT AUTO_INCREMENT NOT NULL, libelle_technique VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE specialite (id INT AUTO_INCREMENT NOT NULL, libelle_motivant VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE avis (id_commentaire INT AUTO_INCREMENT NOT NULL, id_event_atelier INT DEFAULT NULL, avis_utilisateur VARCHAR(500) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, email_utilisateur VARCHAR(500) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, INDEX fk_atelier_avis (id_event_atelier), PRIMARY KEY(id_commentaire)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE coach_motivant_specialite (coach_motivant_id INT NOT NULL, specialite_id INT NOT NULL, INDEX IDX_531326652195E0F0 (specialite_id), INDEX IDX_531326658155999D (coach_motivant_id), PRIMARY KEY(coach_motivant_id, specialite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE event_conference (id INT NOT NULL, theme VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, intervenant VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, INDEX event_conf_fk (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE participer (id_util INT NOT NULL, id_event INT NOT NULL, INDEX I_FK_participer_event_atelier (id_event), INDEX I_FK_participer_utilisateur (id_util), PRIMARY KEY(id_util, id_event)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT fk_id_hack_event FOREIGN KEY (id_hack) REFERENCES hackaton (id)');
        $this->addSql('ALTER TABLE event_atelier ADD CONSTRAINT event_fk FOREIGN KEY (id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE coach_metier_competence_metier ADD CONSTRAINT FK_2101ADE7B67EEB7 FOREIGN KEY (coach_metier_id) REFERENCES coach (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coach_metier_competence_metier ADD CONSTRAINT FK_2101ADED9A38C5D FOREIGN KEY (competence_metier_id) REFERENCES competence_metier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coach_technique_competence_technique ADD CONSTRAINT FK_F8C1EB6B81CDA962 FOREIGN KEY (competence_technique_id) REFERENCES competence_technique (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coach_technique_competence_technique ADD CONSTRAINT FK_F8C1EB6BEE7AF33A FOREIGN KEY (coach_technique_id) REFERENCES coach (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT fk_atelier_avis FOREIGN KEY (id_event_atelier) REFERENCES event_atelier (id)');
        $this->addSql('ALTER TABLE coach_motivant_specialite ADD CONSTRAINT FK_531326652195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coach_motivant_specialite ADD CONSTRAINT FK_531326658155999D FOREIGN KEY (coach_motivant_id) REFERENCES coach (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_conference ADD CONSTRAINT event_conf_fk FOREIGN KEY (id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE participer ADD CONSTRAINT FK_participer_utilisateur FOREIGN KEY (id_util) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE participer ADD CONSTRAINT FK_participer_event_atelier FOREIGN KEY (id_event) REFERENCES event_atelier (id)');
        $this->addSql('ALTER TABLE favoris DROP FOREIGN KEY FK_8933C432FB88E14F');
        $this->addSql('ALTER TABLE favoris DROP FOREIGN KEY FK_8933C432B333DC5B');
        $this->addSql('DROP TABLE favoris');
        $this->addSql('ALTER TABLE hackaton DROP favoris');
    }
}
