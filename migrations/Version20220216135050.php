<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220216135050 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE floor DROP CONSTRAINT fk_be45d62e4d2a7e12');
        $this->addSql('ALTER TABLE apartment DROP CONSTRAINT fk_4d7e6854854679e2');
        $this->addSql('ALTER TABLE building DROP CONSTRAINT fk_e16f61d4900733ed');
        $this->addSql('ALTER TABLE abstract_room DROP CONSTRAINT fk_817b229a176dfe85');
        $this->addSql('DROP SEQUENCE abstract_room_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE floor_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE building_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE apartment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE estate_id_seq CASCADE');
        $this->addSql('DROP TABLE building');
        $this->addSql('DROP TABLE floor');
        $this->addSql('DROP TABLE estate');
        $this->addSql('DROP TABLE abstract_room');
        $this->addSql('DROP TABLE apartment');
        $this->addSql('ALTER TABLE city ALTER area TYPE DOUBLE PRECISION');
        $this->addSql('ALTER TABLE city ALTER area DROP DEFAULT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE abstract_room_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE floor_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE building_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE apartment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE estate_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE building (id INT NOT NULL, estate_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_e16f61d4900733ed ON building (estate_id)');
        $this->addSql('CREATE TABLE floor (id INT NOT NULL, building_id INT DEFAULT NULL, level INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_be45d62e4d2a7e12 ON floor (building_id)');
        $this->addSql('CREATE TABLE estate (id INT NOT NULL, i_owner_fkey BIGINT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_8c4a1aac1a9cb78a ON estate (i_owner_fkey)');
        $this->addSql('CREATE TABLE abstract_room (id INT NOT NULL, apartment_id INT DEFAULT NULL, area INT NOT NULL, discriminator VARCHAR(255) NOT NULL, shower BOOLEAN DEFAULT NULL, "window" BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_817b229a176dfe85 ON abstract_room (apartment_id)');
        $this->addSql('CREATE TABLE apartment (id INT NOT NULL, floor_id INT DEFAULT NULL, price INT NOT NULL, side VARCHAR(255) NOT NULL, garden BOOLEAN NOT NULL, balcony BOOLEAN NOT NULL, area INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_4d7e6854854679e2 ON apartment (floor_id)');
        $this->addSql('ALTER TABLE building ADD CONSTRAINT fk_e16f61d4900733ed FOREIGN KEY (estate_id) REFERENCES estate (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE floor ADD CONSTRAINT fk_be45d62e4d2a7e12 FOREIGN KEY (building_id) REFERENCES building (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE estate ADD CONSTRAINT fk_8c4a1aac1a9cb78a FOREIGN KEY (i_owner_fkey) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE abstract_room ADD CONSTRAINT fk_817b229a176dfe85 FOREIGN KEY (apartment_id) REFERENCES apartment (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE apartment ADD CONSTRAINT fk_4d7e6854854679e2 FOREIGN KEY (floor_id) REFERENCES floor (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE city ALTER area TYPE NUMERIC(10, 0)');
        $this->addSql('ALTER TABLE city ALTER area DROP DEFAULT');
    }
}
