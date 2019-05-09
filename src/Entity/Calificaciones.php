<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Calificaciones
 *
 * @ORM\Table(name="calificaciones", indexes={@ORM\Index(name="IDX_41F72CC8B54DBBCB", columns={"materia_id"}), @ORM\Index(name="IDX_41F72CC8FC28E5EE", columns={"alumno_id"})})
 * @ORM\Entity
 */
class Calificaciones
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="nota", type="float", precision=10, scale=0, nullable=false)
     */
    private $nota;

    /**
     * @var \Materias
     *
     * @ORM\ManyToOne(targetEntity="Materias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="materia_id", referencedColumnName="id")
     * })
     */
    private $materia;

    /**
     * @var \Alumnos
     *
     * @ORM\ManyToOne(targetEntity="Alumnos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="alumno_id", referencedColumnName="id")
     * })
     */
    private $alumno;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ciclos", inversedBy="calificaciones")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ciclos;

    public function getId(): int
    {
        return $this->id;
    }

    public function getNota(): float
    {
        return $this->nota;
    }

    public function setNota(float $nota): self
    {
        $this->nota = $nota;

        return $this;
    }

    public function getMateria(): Materias
    {
        return $this->materia;
    }

    public function setMateria(Materias $materia): self
    {
        $this->materia = $materia;

        return $this;
    }

    public function getAlumno(): Alumnos
    {
        return $this->alumno;
    }

    public function setAlumno(Alumnos $alumno): self
    {
        $this->alumno = $alumno;

        return $this;
    }
	public function __toString(){
         		return $this->nota;
         	}

    public function getCiclos(): Ciclos
    {
        return $this->ciclos;
    }

    public function setCiclos(Ciclos $ciclos): self
    {
        $this->ciclos = $ciclos;

        return $this;
    }


}
