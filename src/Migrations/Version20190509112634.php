<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190509112634 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE calificaciones ADD ciclos_id INT NOT NULL, DROP ciclo, DROP porcentaje');
        $this->addSql('ALTER TABLE calificaciones ADD CONSTRAINT FK_41F72CC872C378CA FOREIGN KEY (ciclos_id) REFERENCES ciclos (id)');
        $this->addSql('CREATE INDEX IDX_41F72CC872C378CA ON calificaciones (ciclos_id)');
        $this->addSql('ALTER TABLE ciclos CHANGE porcentaje porcentaje DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE calificaciones DROP FOREIGN KEY FK_41F72CC872C378CA');
        $this->addSql('DROP INDEX IDX_41F72CC872C378CA ON calificaciones');
        $this->addSql('ALTER TABLE calificaciones ADD ciclo VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD porcentaje INT DEFAULT NULL, DROP ciclos_id');
        $this->addSql('ALTER TABLE ciclos CHANGE porcentaje porcentaje DOUBLE PRECISION NOT NULL');
    }
}
