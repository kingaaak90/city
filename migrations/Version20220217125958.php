<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220217125958 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE district_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE City (id INT NOT NULL, city_name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE district (id INT NOT NULL, city_id INT DEFAULT NULL, district_name VARCHAR(255) NOT NULL, population INT NOT NULL, area DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_31C154878BAC62AF ON district (city_id)');
        $this->addSql('ALTER TABLE district ADD CONSTRAINT FK_31C154878BAC62AF FOREIGN KEY (city_id) REFERENCES City (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE district DROP CONSTRAINT FK_31C154878BAC62AF');
        $this->addSql('DROP SEQUENCE district_id_seq CASCADE');
        $this->addSql('DROP TABLE City');
        $this->addSql('DROP TABLE district');
    }
}
