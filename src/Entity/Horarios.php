<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Horarios
 *
 * @ORM\Table(name="horarios", indexes={@ORM\Index(name="IDX_5433650A7C1D59C9", columns={"id_alumno_id"})})
 * @ORM\Entity
 */
class Horarios
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
     * @var \DateTime
     *
     * @ORM\Column(name="hora_inicio", type="time", nullable=false)
     */
    private $horaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_final", type="time", nullable=false)
     */
    private $horaFinal;

    /**
     * @var int
     *
     * @ORM\Column(name="dia", type="integer", nullable=false)
     */
    private $dia;

    /**
     * @var string
     *
     * @ORM\Column(name="actividad", type="string", length=255, nullable=false)
     */
    private $actividad;

    /**
     * @var \Alumnos
     *
     * @ORM\ManyToOne(targetEntity="Alumnos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_alumno_id", referencedColumnName="id")
     * })
     */
    private $idAlumno;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHoraInicio(): ?\DateTimeInterface
    {
        return $this->horaInicio;
    }

    public function setHoraInicio(\DateTimeInterface $horaInicio): self
    {
        $this->horaInicio = $horaInicio;

        return $this;
    }

    public function getHoraFinal(): ?\DateTimeInterface
    {
        return $this->horaFinal;
    }

    public function setHoraFinal(\DateTimeInterface $horaFinal): self
    {
        $this->horaFinal = $horaFinal;

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

    public function getIdAlumno(): ?Alumnos
    {
        return $this->idAlumno;
    }

    public function setIdAlumno(?Alumnos $idAlumno): self
    {
        $this->idAlumno = $idAlumno;

        return $this;
    }


}
