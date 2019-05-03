<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Wiki
 *
 * @ORM\Table(name="wiki", indexes={@ORM\Index(name="IDX_22CDDC06B54DBBCB", columns={"materia_id"})})
 * @ORM\Entity
 */
class Wiki
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
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=255, nullable=false)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="cuerpo", type="text", length=0, nullable=false)
     */
    private $cuerpo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="hashtag", type="string", length=255, nullable=true)
     */
    private $hashtag;

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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Alumnos", inversedBy="wiki")
     * @ORM\JoinTable(name="wiki_alumnos",
     *   joinColumns={
     *     @ORM\JoinColumn(name="wiki_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="alumnos_id", referencedColumnName="id")
     *   }
     * )
     */
    private $alumnos;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->alumnos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getCuerpo(): ?string
    {
        return $this->cuerpo;
    }

    public function setCuerpo(string $cuerpo): self
    {
        $this->cuerpo = $cuerpo;

        return $this;
    }

    public function getHashtag(): ?string
    {
        return $this->hashtag;
    }

    public function setHashtag(?string $hashtag): self
    {
        $this->hashtag = $hashtag;

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

    /**
     * @return Collection|Alumnos[]
     */
    public function getAlumnos(): Collection
    {
        return $this->alumnos;
    }

    public function addAlumno(Alumnos $alumno): self
    {
        if (!$this->alumnos->contains($alumno)) {
            $this->alumnos[] = $alumno;
        }

        return $this;
    }

    public function removeAlumno(Alumnos $alumno): self
    {
        if ($this->alumnos->contains($alumno)) {
            $this->alumnos->removeElement($alumno);
        }

        return $this;
    }

}
