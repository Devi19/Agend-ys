<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recursos
 *
 * @ORM\Table(name="recursos", indexes={@ORM\Index(name="IDX_5163D17DFC28E5EE", columns={"alumno_id"}), @ORM\Index(name="IDX_5163D17DB54DBBCB", columns={"materia_id"})})
 * @ORM\Entity
 */
class Recursos
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="tipos_archivo", type="string", length=10, nullable=false)
     */
    private $tiposArchivo;

    /**
     * @var float
     *
     * @ORM\Column(name="tamano", type="float", precision=10, scale=0, nullable=false)
     */
    private $tamano;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=false)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=false)
     */
    private $url;

    /**
     * @var \Materias
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Materias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="materia_id", referencedColumnName="id")
     * })
     */
    private $materia;

    /**
     * @var \Alumnos
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Alumnos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="alumno_id", referencedColumnName="id")
     * })
     */
    private $alumno;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTiposArchivo(): ?string
    {
        return $this->tiposArchivo;
    }

    public function setTiposArchivo(string $tiposArchivo): self
    {
        $this->tiposArchivo = $tiposArchivo;

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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

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

    public function getAlumno(): ?Alumnos
    {
        return $this->alumno;
    }

    public function setAlumno(?Alumnos $alumno): self
    {
        $this->alumno = $alumno;

        return $this;
    }


}
