<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220211095149 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE building_building_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE estate_estate_id_seq CASCADE');
        $this->addSql('ALTER TABLE building ADD estate_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE building DROP estate');
        $this->addSql('ALTER TABLE building DROP floors');
        $this->addSql('ALTER TABLE building ADD CONSTRAINT FK_E16F61D4900733ED FOREIGN KEY (estate_id) REFERENCES estate (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_E16F61D4900733ED ON building (estate_id)');
        $this->addSql('ALTER TABLE floor ADD building_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE floor DROP building');
        $this->addSql('ALTER TABLE floor ADD CONSTRAINT FK_BE45D62E4D2A7E12 FOREIGN KEY (building_id) REFERENCES building (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_BE45D62E4D2A7E12 ON floor (building_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE building_building_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE estate_estate_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE building DROP CONSTRAINT FK_E16F61D4900733ED');
        $this->addSql('DROP INDEX IDX_E16F61D4900733ED');
        $this->addSql('ALTER TABLE building ADD estate INT NOT NULL');
        $this->addSql('ALTER TABLE building ADD floors INT NOT NULL');
        $this->addSql('ALTER TABLE building DROP estate_id');
        $this->addSql('ALTER TABLE floor DROP CONSTRAINT FK_BE45D62E4D2A7E12');
        $this->addSql('DROP INDEX IDX_BE45D62E4D2A7E12');
        $this->addSql('ALTER TABLE floor ADD building INT NOT NULL');
        $this->addSql('ALTER TABLE floor DROP building_id');
    }
}
