<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MateriasRepository")
 */
class Materias
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\alumnos", inversedBy="materias")
     */
    private $id_alumno;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Calificaciones", mappedBy="materia")
     */
    private $calificaciones;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Recursos", mappedBy="materia")
     */
    private $recursos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Recordatorios", mappedBy="materia")
     */
    private $recordatorios;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Wiki", mappedBy="materia")
     */
    private $wikis;

    public function __construct()
    {
        $this->id_alumno = new ArrayCollection();
        $this->calificaciones = new ArrayCollection();
        $this->recursos = new ArrayCollection();
        $this->recordatorios = new ArrayCollection();
        $this->wikis = new ArrayCollection();
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
     * @return Collection|alumnos[]
     */
    public function getIdAlumno(): Collection
    {
        return $this->id_alumno;
    }

    public function addIdAlumno(alumnos $idAlumno): self
    {
        if (!$this->id_alumno->contains($idAlumno)) {
            $this->id_alumno[] = $idAlumno;
        }

        return $this;
    }

    public function removeIdAlumno(alumnos $idAlumno): self
    {
        if ($this->id_alumno->contains($idAlumno)) {
            $this->id_alumno->removeElement($idAlumno);
        }

        return $this;
    }

    /**
     * @return Collection|Calificaciones[]
     */
    public function getCalificaciones(): Collection
    {
        return $this->calificaciones;
    }

    public function addCalificacione(Calificaciones $calificacione): self
    {
        if (!$this->calificaciones->contains($calificacione)) {
            $this->calificaciones[] = $calificacione;
            $calificacione->setMateria($this);
        }

        return $this;
    }

    public function removeCalificacione(Calificaciones $calificacione): self
    {
        if ($this->calificaciones->contains($calificacione)) {
            $this->calificaciones->removeElement($calificacione);
            // set the owning side to null (unless already changed)
            if ($calificacione->getMateria() === $this) {
                $calificacione->setMateria(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Recursos[]
     */
    public function getRecursos(): Collection
    {
        return $this->recursos;
    }

    public function addRecurso(Recursos $recurso): self
    {
        if (!$this->recursos->contains($recurso)) {
            $this->recursos[] = $recurso;
            $recurso->setMateria($this);
        }

        return $this;
    }

    public function removeRecurso(Recursos $recurso): self
    {
        if ($this->recursos->contains($recurso)) {
            $this->recursos->removeElement($recurso);
            // set the owning side to null (unless already changed)
            if ($recurso->getMateria() === $this) {
                $recurso->setMateria(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Recordatorios[]
     */
    public function getRecordatorios(): Collection
    {
        return $this->recordatorios;
    }

    public function addRecordatorio(Recordatorios $recordatorio): self
    {
        if (!$this->recordatorios->contains($recordatorio)) {
            $this->recordatorios[] = $recordatorio;
            $recordatorio->setMateria($this);
        }

        return $this;
    }

    public function removeRecordatorio(Recordatorios $recordatorio): self
    {
        if ($this->recordatorios->contains($recordatorio)) {
            $this->recordatorios->removeElement($recordatorio);
            // set the owning side to null (unless already changed)
            if ($recordatorio->getMateria() === $this) {
                $recordatorio->setMateria(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Wiki[]
     */
    public function getWikis(): Collection
    {
        return $this->wikis;
    }

    public function addWiki(Wiki $wiki): self
    {
        if (!$this->wikis->contains($wiki)) {
            $this->wikis[] = $wiki;
            $wiki->setMateria($this);
        }

        return $this;
    }

    public function removeWiki(Wiki $wiki): self
    {
        if ($this->wikis->contains($wiki)) {
            $this->wikis->removeElement($wiki);
            // set the owning side to null (unless already changed)
            if ($wiki->getMateria() === $this) {
                $wiki->setMateria(null);
            }
        }

        return $this;
    }
}
