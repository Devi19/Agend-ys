<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CiclosRepository")
 */
class Ciclos
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombre;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $porcentaje;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Calificaciones", mappedBy="ciclos")
     */
    private $calificaciones;

    public function __construct()
    {
        $this->calificaciones = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?int
    {
        return $this->nombre;
    }

    public function setNombre(int $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getPorcentaje(): ?float
    {
        return $this->porcentaje;
    }

    public function setPorcentaje(?float $porcentaje): self
    {
        $this->porcentaje = $porcentaje;

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
            $calificacione->setCiclos($this);
        }

        return $this;
    }

    public function removeCalificacione(Calificaciones $calificacione): self
    {
        if ($this->calificaciones->contains($calificacione)) {
            $this->calificaciones->removeElement($calificacione);
            // set the owning side to null (unless already changed)
            if ($calificacione->getCiclos() === $this) {
                $calificacione->setCiclos(null);
            }
        }

        return $this;
    }
}
