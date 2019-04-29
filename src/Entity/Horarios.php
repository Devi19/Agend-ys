<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HorariosRepository")
 */
class Horarios
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time")
     */
    private $hora_inicio;

    /**
     * @ORM\Column(type="time")
     */
    private $hora_final;

    /**
     * @ORM\Column(type="integer")
     */
    private $dia;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $actividad;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\alumnos", inversedBy="horarios")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_alumno;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHoraInicio(): ?\DateTimeInterface
    {
        return $this->hora_inicio;
    }

    public function setHoraInicio(\DateTimeInterface $hora_inicio): self
    {
        $this->hora_inicio = $hora_inicio;

        return $this;
    }

    public function getHoraFinal(): ?\DateTimeInterface
    {
        return $this->hora_final;
    }

    public function setHoraFinal(\DateTimeInterface $hora_final): self
    {
        $this->hora_final = $hora_final;

        return $this;
    }

    public function getDia(): ?int
    {
        return $this->dia;
    }

    public function setDia(int $dia): self
    {
        $this->dia = $dia;

        return $this;
    }

    public function getActividad(): ?string
    {
        return $this->actividad;
    }

    public function setActividad(string $actividad): self
    {
        $this->actividad = $actividad;

        return $this;
    }

    public function getIdAlumno(): ?alumnos
    {
        return $this->id_alumno;
    }

    public function setIdAlumno(?alumnos $id_alumno): self
    {
        $this->id_alumno = $id_alumno;

        return $this;
    }
}
