<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CalificacionesRepository")
 */
class Calificaciones
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $nota;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ciclo;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $porcentaje;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\alumnos", inversedBy="calificaciones")
     * @ORM\JoinColumn(nullable=false)
     */
    private $alumno;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Materias", inversedBy="calificaciones")
     * @ORM\JoinColumn(nullable=false)
     */
    private $materia;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNota(): ?float
    {
        return $this->nota;
    }

    public function setNota(float $nota): self
    {
        $this->nota = $nota;

        return $this;
    }

    public function getCiclo(): ?string
    {
        return $this->ciclo;
    }

    public function setCiclo(string $ciclo): self
    {
        $this->ciclo = $ciclo;

        return $this;
    }

    public function getPorcentaje(): ?int
    {
        return $this->porcentaje;
    }

    public function setPorcentaje(?int $porcentaje): self
    {
        $this->porcentaje = $porcentaje;

        return $this;
    }

    public function getAlumno(): ?alumnos
    {
        return $this->alumno;
    }

    public function setAlumno(?alumnos $alumno): self
    {
        $this->alumno = $alumno;

        return $this;
    }

    public function getMateria(): ?Materias
    {
        return $this->materia;
    }

    public function setMateria(?Materias $materia): self
    {
        $this->materia = $materia;

        return $this;
    }
}
