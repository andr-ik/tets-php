<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190709162054 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE flat (id SERIAL NOT NULL, complex_id INT NOT NULL, area DOUBLE PRECISION NOT NULL, external_id INT NOT NULL, floor INT NOT NULL, deadline VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_554AAA44E4695F7C ON flat (complex_id)');
        $this->addSql('CREATE TABLE complex (id SERIAL NOT NULL, title VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE history (id SERIAL NOT NULL, flat_id INT NOT NULL, date DATE NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_27BA704BD3331C94 ON history (flat_id)');
        $this->addSql('ALTER TABLE flat ADD CONSTRAINT FK_554AAA44E4695F7C FOREIGN KEY (complex_id) REFERENCES complex (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE history ADD CONSTRAINT FK_27BA704BD3331C94 FOREIGN KEY (flat_id) REFERENCES flat (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE history DROP CONSTRAINT FK_27BA704BD3331C94');
        $this->addSql('ALTER TABLE flat DROP CONSTRAINT FK_554AAA44E4695F7C');
        $this->addSql('DROP TABLE flat');
        $this->addSql('DROP TABLE complex');
        $this->addSql('DROP TABLE history');
    }
}
