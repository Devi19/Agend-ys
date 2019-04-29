<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RecursosRepository")
 */
class Recursos
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $tipos_archivo;

    /**
     * @ORM\Column(type="float")
     */
    private $tamano;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Alumnos", inversedBy="recursos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $alumno;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Materias", inversedBy="recursos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $materia;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTiposArchivo(): ?string
    {
        return $this->tipos_archivo;
    }

    public function setTiposArchivo(string $tipos_archivo): self
    {
        $this->tipos_archivo = $tipos_archivo;

        return $this;
    }

    public function getTamano(): ?float
    {
        return $this->tamano;
    }

    public function setTamano(float $tamano): self
    {
        $this->tamano = $tamano;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getAlumno(): ?Alumnos
    {
        return $this->alumno;
    }

    public function setAlumno(?Alumnos $alumno): self
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
