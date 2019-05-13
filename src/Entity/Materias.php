<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Materias
 *
 * @ORM\Table(name="materias")
 * @ORM\Entity
 */
class Materias
{
<<<<<<< HEAD
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
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Alumnos", inversedBy="materias")
     * @ORM\JoinTable(name="materias_alumnos",
     *   joinColumns={
     *     @ORM\JoinColumn(name="materias_id", referencedColumnName="id")
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

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

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
    public function __toString()
    {
        return $this->nombre;
    }
=======
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
 * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
 */
private $nombre;

/**
 * @var \Doctrine\Common\Collections\Collection
 *
 * @ORM\ManyToMany(targetEntity="Alumnos", inversedBy="materias")
 * @ORM\JoinTable(name="materias_alumnos",
 *   joinColumns={
 *     @ORM\JoinColumn(name="materias_id", referencedColumnName="id")
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

public function getNombre(): ?string
{
return $this->nombre;
}

public function setNombre(string $nombre): self
{
$this->nombre = $nombre;

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

public function __toString(){
return $this->nombre;
}
>>>>>>> 2d3c067c46c65c8f367c22109bf0ef2ea7ed39fe

}
