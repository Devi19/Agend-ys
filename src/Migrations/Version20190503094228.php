<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190503094228 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE wiki (id INT AUTO_INCREMENT NOT NULL, materia_id INT NOT NULL, titulo VARCHAR(255) NOT NULL, cuerpo LONGTEXT NOT NULL, hashtag VARCHAR(255) DEFAULT NULL, INDEX IDX_22CDDC06B54DBBCB (materia_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wiki_alumnos (wiki_id INT NOT NULL, alumnos_id INT NOT NULL, INDEX IDX_96F6566EAA948DBE (wiki_id), INDEX IDX_96F6566EA03F5ABF (alumnos_id), PRIMARY KEY(wiki_id, alumnos_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorias (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE alumnos (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, apellidos VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, foto VARCHAR(55) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE alumnos_alumnos (alumnos_source INT NOT NULL, alumnos_target INT NOT NULL, INDEX IDX_3FD7A4F52677F2AD (alumnos_source), INDEX IDX_3FD7A4F53F92A222 (alumnos_target), PRIMARY KEY(alumnos_source, alumnos_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recordatorios (id INT AUTO_INCREMENT NOT NULL, alumno_id INT NOT NULL, materia_id INT NOT NULL, categoria_id INT NOT NULL, titulo VARCHAR(255) NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, fecha DATETIME NOT NULL, INDEX IDX_D4A59CFFC28E5EE (alumno_id), INDEX IDX_D4A59CFB54DBBCB (materia_id), INDEX IDX_D4A59CF3397707A (categoria_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE horarios (id INT AUTO_INCREMENT NOT NULL, id_alumno_id INT NOT NULL, hora_inicio TIME NOT NULL, hora_final TIME NOT NULL, dia INT NOT NULL, actividad VARCHAR(255) NOT NULL, INDEX IDX_5433650A7C1D59C9 (id_alumno_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recursos (id INT AUTO_INCREMENT NOT NULL, alumno_id INT NOT NULL, materia_id INT NOT NULL, tipos_archivo VARCHAR(10) NOT NULL, tamano DOUBLE PRECISION NOT NULL, nombre VARCHAR(255) NOT NULL, INDEX IDX_5163D17DFC28E5EE (alumno_id), INDEX IDX_5163D17DB54DBBCB (materia_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materias (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materias_alumnos (materias_id INT NOT NULL, alumnos_id INT NOT NULL, INDEX IDX_9C26F0A4EB72EBA6 (materias_id), INDEX IDX_9C26F0A4A03F5ABF (alumnos_id), PRIMARY KEY(materias_id, alumnos_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE calificaciones (id INT AUTO_INCREMENT NOT NULL, alumno_id INT NOT NULL, materia_id INT NOT NULL, nota DOUBLE PRECISION NOT NULL, ciclo VARCHAR(255) NOT NULL, porcentaje INT DEFAULT NULL, INDEX IDX_41F72CC8FC28E5EE (alumno_id), INDEX IDX_41F72CC8B54DBBCB (materia_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE wiki ADD CONSTRAINT FK_22CDDC06B54DBBCB FOREIGN KEY (materia_id) REFERENCES materias (id)');
        $this->addSql('ALTER TABLE wiki_alumnos ADD CONSTRAINT FK_96F6566EAA948DBE FOREIGN KEY (wiki_id) REFERENCES wiki (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE wiki_alumnos ADD CONSTRAINT FK_96F6566EA03F5ABF FOREIGN KEY (alumnos_id) REFERENCES alumnos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE alumnos_alumnos ADD CONSTRAINT FK_3FD7A4F52677F2AD FOREIGN KEY (alumnos_source) REFERENCES alumnos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE alumnos_alumnos ADD CONSTRAINT FK_3FD7A4F53F92A222 FOREIGN KEY (alumnos_target) REFERENCES alumnos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recordatorios ADD CONSTRAINT FK_D4A59CFFC28E5EE FOREIGN KEY (alumno_id) REFERENCES alumnos (id)');
        $this->addSql('ALTER TABLE recordatorios ADD CONSTRAINT FK_D4A59CFB54DBBCB FOREIGN KEY (materia_id) REFERENCES materias (id)');
        $this->addSql('ALTER TABLE recordatorios ADD CONSTRAINT FK_D4A59CF3397707A FOREIGN KEY (categoria_id) REFERENCES categorias (id)');
        $this->addSql('ALTER TABLE horarios ADD CONSTRAINT FK_5433650A7C1D59C9 FOREIGN KEY (id_alumno_id) REFERENCES alumnos (id)');
        $this->addSql('ALTER TABLE recursos ADD CONSTRAINT FK_5163D17DFC28E5EE FOREIGN KEY (alumno_id) REFERENCES alumnos (id)');
        $this->addSql('ALTER TABLE recursos ADD CONSTRAINT FK_5163D17DB54DBBCB FOREIGN KEY (materia_id) REFERENCES materias (id)');
        $this->addSql('ALTER TABLE materias_alumnos ADD CONSTRAINT FK_9C26F0A4EB72EBA6 FOREIGN KEY (materias_id) REFERENCES materias (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE materias_alumnos ADD CONSTRAINT FK_9C26F0A4A03F5ABF FOREIGN KEY (alumnos_id) REFERENCES alumnos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE calificaciones ADD CONSTRAINT FK_41F72CC8FC28E5EE FOREIGN KEY (alumno_id) REFERENCES alumnos (id)');
        $this->addSql('ALTER TABLE calificaciones ADD CONSTRAINT FK_41F72CC8B54DBBCB FOREIGN KEY (materia_id) REFERENCES materias (id)');
        $this->addSql('ALTER TABLE app_user ADD alumno_id INT NOT NULL');
        $this->addSql('ALTER TABLE app_user ADD CONSTRAINT FK_88BDF3E9FC28E5EE FOREIGN KEY (alumno_id) REFERENCES alumnos (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_88BDF3E9FC28E5EE ON app_user (alumno_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE wiki_alumnos DROP FOREIGN KEY FK_96F6566EAA948DBE');
        $this->addSql('ALTER TABLE recordatorios DROP FOREIGN KEY FK_D4A59CF3397707A');
        $this->addSql('ALTER TABLE wiki_alumnos DROP FOREIGN KEY FK_96F6566EA03F5ABF');
        $this->addSql('ALTER TABLE alumnos_alumnos DROP FOREIGN KEY FK_3FD7A4F52677F2AD');
        $this->addSql('ALTER TABLE alumnos_alumnos DROP FOREIGN KEY FK_3FD7A4F53F92A222');
        $this->addSql('ALTER TABLE recordatorios DROP FOREIGN KEY FK_D4A59CFFC28E5EE');
        $this->addSql('ALTER TABLE horarios DROP FOREIGN KEY FK_5433650A7C1D59C9');
        $this->addSql('ALTER TABLE recursos DROP FOREIGN KEY FK_5163D17DFC28E5EE');
        $this->addSql('ALTER TABLE materias_alumnos DROP FOREIGN KEY FK_9C26F0A4A03F5ABF');
        $this->addSql('ALTER TABLE calificaciones DROP FOREIGN KEY FK_41F72CC8FC28E5EE');
        $this->addSql('ALTER TABLE app_user DROP FOREIGN KEY FK_88BDF3E9FC28E5EE');
        $this->addSql('ALTER TABLE wiki DROP FOREIGN KEY FK_22CDDC06B54DBBCB');
        $this->addSql('ALTER TABLE recordatorios DROP FOREIGN KEY FK_D4A59CFB54DBBCB');
        $this->addSql('ALTER TABLE recursos DROP FOREIGN KEY FK_5163D17DB54DBBCB');
        $this->addSql('ALTER TABLE materias_alumnos DROP FOREIGN KEY FK_9C26F0A4EB72EBA6');
        $this->addSql('ALTER TABLE calificaciones DROP FOREIGN KEY FK_41F72CC8B54DBBCB');
        $this->addSql('DROP TABLE wiki');
        $this->addSql('DROP TABLE wiki_alumnos');
        $this->addSql('DROP TABLE categorias');
        $this->addSql('DROP TABLE alumnos');
        $this->addSql('DROP TABLE alumnos_alumnos');
        $this->addSql('DROP TABLE recordatorios');
        $this->addSql('DROP TABLE horarios');
        $this->addSql('DROP TABLE recursos');
        $this->addSql('DROP TABLE materias');
        $this->addSql('DROP TABLE materias_alumnos');
        $this->addSql('DROP TABLE calificaciones');
        $this->addSql('DROP INDEX UNIQ_88BDF3E9FC28E5EE ON app_user');
        $this->addSql('ALTER TABLE app_user DROP alumno_id');
    }
}
