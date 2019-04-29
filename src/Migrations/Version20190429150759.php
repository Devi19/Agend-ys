<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190429150759 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE alumnos_alumnos (alumnos_source INT NOT NULL, alumnos_target INT NOT NULL, INDEX IDX_3FD7A4F52677F2AD (alumnos_source), INDEX IDX_3FD7A4F53F92A222 (alumnos_target), PRIMARY KEY(alumnos_source, alumnos_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE alumnos_alumnos ADD CONSTRAINT FK_3FD7A4F52677F2AD FOREIGN KEY (alumnos_source) REFERENCES alumnos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE alumnos_alumnos ADD CONSTRAINT FK_3FD7A4F53F92A222 FOREIGN KEY (alumnos_target) REFERENCES alumnos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_user ADD CONSTRAINT FK_88BDF3E9FC28E5EE FOREIGN KEY (alumno_id) REFERENCES alumnos (id)');
        $this->addSql('CREATE INDEX IDX_88BDF3E9FC28E5EE ON app_user (alumno_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE alumnos_alumnos');
        $this->addSql('ALTER TABLE app_user DROP FOREIGN KEY FK_88BDF3E9FC28E5EE');
        $this->addSql('DROP INDEX IDX_88BDF3E9FC28E5EE ON app_user');
    }
}
