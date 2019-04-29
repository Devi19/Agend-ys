<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoriasRepository")
 */
class Categorias
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Recordatorios", mappedBy="categoria")
     */
    private $recordatorios;

    public function __construct()
    {
        $this->recordatorios = new ArrayCollection();
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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

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
            $recordatorio->setCategoria($this);
        }

        return $this;
    }

    public function removeRecordatorio(Recordatorios $recordatorio): self
    {
        if ($this->recordatorios->contains($recordatorio)) {
            $this->recordatorios->removeElement($recordatorio);
            // set the owning side to null (unless already changed)
            if ($recordatorio->getCategoria() === $this) {
                $recordatorio->setCategoria(null);
            }
        }

        return $this;
    }
}
