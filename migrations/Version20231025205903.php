<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231025205903 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__weather AS SELECT id, temperature, humidity, wind, pressure, uv FROM weather');
        $this->addSql('DROP TABLE weather');
        $this->addSql('CREATE TABLE weather (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, location_id INTEGER NOT NULL, temperature VARCHAR(255) NOT NULL, humidity VARCHAR(255) NOT NULL, wind VARCHAR(255) NOT NULL, pressure VARCHAR(255) NOT NULL, uv VARCHAR(255) NOT NULL, date DATE NOT NULL, CONSTRAINT FK_4CD0D36E64D218E FOREIGN KEY (location_id) REFERENCES location (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO weather (id, temperature, humidity, wind, pressure, uv) SELECT id, temperature, humidity, wind, pressure, uv FROM __temp__weather');
        $this->addSql('DROP TABLE __temp__weather');
        $this->addSql('CREATE INDEX IDX_4CD0D36E64D218E ON weather (location_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__weather AS SELECT id, temperature, humidity, wind, pressure, uv FROM weather');
        $this->addSql('DROP TABLE weather');
        $this->addSql('CREATE TABLE weather (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, temperature VARCHAR(255) NOT NULL, humidity VARCHAR(255) NOT NULL, wind VARCHAR(255) NOT NULL, pressure VARCHAR(255) NOT NULL, uv VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO weather (id, temperature, humidity, wind, pressure, uv) SELECT id, temperature, humidity, wind, pressure, uv FROM __temp__weather');
        $this->addSql('DROP TABLE __temp__weather');
    }
}
