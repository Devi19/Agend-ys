<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Calificaciones
 *
 * @ORM\Table(name="calificaciones", indexes={@ORM\Index(name="id_materia", columns={"id_materia"}), @ORM\Index(name="IDX_41F72CC8320260C0", columns={"id_alumno"}), @ORM\Index(name="id_ciclo", columns={"id_ciclo"})})
 * @ORM\Entity
 */
class Calificaciones
{
/**
 * @var float
 *
 * @ORM\Column(name="nota", type="float", precision=10, scale=0, nullable=false)
 */
private $nota;

/**
 * @var \Alumnos
 *
 * @ORM\Id
 * @ORM\GeneratedValue(strategy="NONE")
 * @ORM\OneToOne(targetEntity="Alumnos")
 * @ORM\JoinColumns({
 *   @ORM\JoinColumn(name="id_alumno", referencedColumnName="id")
 * })
 */
private $idAlumno;

/**
 * @var \Materias
 *
 * @ORM\Id
 * @ORM\GeneratedValue(strategy="NONE")
 * @ORM\OneToOne(targetEntity="Materias")
 * @ORM\JoinColumns({
 *   @ORM\JoinColumn(name="id_materia", referencedColumnName="id")
 * })
 */
private $idMateria;

/**
 * @var \Ciclos
 *
 * @ORM\Id
 * @ORM\GeneratedValue(strategy="NONE")
 * @ORM\OneToOne(targetEntity="Ciclos")
 * @ORM\JoinColumns({
 *   @ORM\JoinColumn(name="id_ciclo", referencedColumnName="id")
 * })
 */
private $idCiclo;

public function getNota(): ?float
{
return $this->nota;
}

public function setNota(float $nota): self
{
$this->nota = $nota;

return $this;
}

public function getIdAlumno(): ?Alumnos
{
return $this->idAlumno;
}

public function setIdAlumno(?Alumnos $idAlumno): self
{
$this->idAlumno = $idAlumno;

return $this;
}

public function getIdMateria(): ?Materias
{
return $this->idMateria;
}

public function setIdMateria(?Materias $idMateria): self
{
$this->idMateria = $idMateria;

return $this;
}

public function getIdCiclo(): ?Ciclos
{
return $this->idCiclo;
}

public function setIdCiclo(?Ciclos $idCiclo): self
{
$this->idCiclo = $idCiclo;

return $this;
}

public function __toString(){
return $this->nota;
}

}
