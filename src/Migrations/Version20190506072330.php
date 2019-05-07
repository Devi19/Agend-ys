<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190506072330 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE wiki CHANGE materia_id materia_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE wiki_alumnos DROP FOREIGN KEY FK_96F6566EA03F5ABF');
        $this->addSql('ALTER TABLE wiki_alumnos DROP FOREIGN KEY FK_96F6566EAA948DBE');
        $this->addSql('ALTER TABLE wiki_alumnos ADD CONSTRAINT FK_96F6566EA03F5ABF FOREIGN KEY (alumnos_id) REFERENCES alumnos (id)');
        $this->addSql('ALTER TABLE wiki_alumnos ADD CONSTRAINT FK_96F6566EAA948DBE FOREIGN KEY (wiki_id) REFERENCES wiki (id)');
        $this->addSql('ALTER TABLE alumnos ADD password TEXT NOT NULL, ADD role VARCHAR(50) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX email ON alumnos (email)');
        $this->addSql('ALTER TABLE alumnos_alumnos DROP FOREIGN KEY FK_3FD7A4F52677F2AD');
        $this->addSql('ALTER TABLE alumnos_alumnos DROP FOREIGN KEY FK_3FD7A4F53F92A222');
        $this->addSql('ALTER TABLE alumnos_alumnos ADD CONSTRAINT FK_3FD7A4F52677F2AD FOREIGN KEY (alumnos_source) REFERENCES alumnos (id)');
        $this->addSql('ALTER TABLE alumnos_alumnos ADD CONSTRAINT FK_3FD7A4F53F92A222 FOREIGN KEY (alumnos_target) REFERENCES alumnos (id)');
        $this->addSql('ALTER TABLE recordatorios CHANGE alumno_id alumno_id INT DEFAULT NULL, CHANGE materia_id materia_id INT DEFAULT NULL, CHANGE categoria_id categoria_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE horarios CHANGE id_alumno_id id_alumno_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recursos CHANGE alumno_id alumno_id INT DEFAULT NULL, CHANGE materia_id materia_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE materias_alumnos DROP FOREIGN KEY FK_9C26F0A4A03F5ABF');
        $this->addSql('ALTER TABLE materias_alumnos DROP FOREIGN KEY FK_9C26F0A4EB72EBA6');
        $this->addSql('ALTER TABLE materias_alumnos ADD CONSTRAINT FK_9C26F0A4A03F5ABF FOREIGN KEY (alumnos_id) REFERENCES alumnos (id)');
        $this->addSql('ALTER TABLE materias_alumnos ADD CONSTRAINT FK_9C26F0A4EB72EBA6 FOREIGN KEY (materias_id) REFERENCES materias (id)');
        $this->addSql('ALTER TABLE calificaciones CHANGE alumno_id alumno_id INT DEFAULT NULL, CHANGE materia_id materia_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX email ON alumnos');
        $this->addSql('ALTER TABLE alumnos DROP password, DROP role');
        $this->addSql('ALTER TABLE alumnos_alumnos DROP FOREIGN KEY FK_3FD7A4F52677F2AD');
        $this->addSql('ALTER TABLE alumnos_alumnos DROP FOREIGN KEY FK_3FD7A4F53F92A222');
        $this->addSql('ALTER TABLE alumnos_alumnos ADD CONSTRAINT FK_3FD7A4F52677F2AD FOREIGN KEY (alumnos_source) REFERENCES alumnos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE alumnos_alumnos ADD CONSTRAINT FK_3FD7A4F53F92A222 FOREIGN KEY (alumnos_target) REFERENCES alumnos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE calificaciones CHANGE materia_id materia_id INT NOT NULL, CHANGE alumno_id alumno_id INT NOT NULL');
        $this->addSql('ALTER TABLE horarios CHANGE id_alumno_id id_alumno_id INT NOT NULL');
        $this->addSql('ALTER TABLE materias_alumnos DROP FOREIGN KEY FK_9C26F0A4EB72EBA6');
        $this->addSql('ALTER TABLE materias_alumnos DROP FOREIGN KEY FK_9C26F0A4A03F5ABF');
        $this->addSql('ALTER TABLE materias_alumnos ADD CONSTRAINT FK_9C26F0A4EB72EBA6 FOREIGN KEY (materias_id) REFERENCES materias (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE materias_alumnos ADD CONSTRAINT FK_9C26F0A4A03F5ABF FOREIGN KEY (alumnos_id) REFERENCES alumnos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recordatorios CHANGE categoria_id categoria_id INT NOT NULL, CHANGE materia_id materia_id INT NOT NULL, CHANGE alumno_id alumno_id INT NOT NULL');
        $this->addSql('ALTER TABLE recursos CHANGE materia_id materia_id INT NOT NULL, CHANGE alumno_id alumno_id INT NOT NULL');
        $this->addSql('ALTER TABLE wiki CHANGE materia_id materia_id INT NOT NULL');
        $this->addSql('ALTER TABLE wiki_alumnos DROP FOREIGN KEY FK_96F6566EAA948DBE');
        $this->addSql('ALTER TABLE wiki_alumnos DROP FOREIGN KEY FK_96F6566EA03F5ABF');
        $this->addSql('ALTER TABLE wiki_alumnos ADD CONSTRAINT FK_96F6566EAA948DBE FOREIGN KEY (wiki_id) REFERENCES wiki (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE wiki_alumnos ADD CONSTRAINT FK_96F6566EA03F5ABF FOREIGN KEY (alumnos_id) REFERENCES alumnos (id) ON DELETE CASCADE');
    }
}
