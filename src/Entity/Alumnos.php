<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AlumnosRepository")
 */
class Alumnos
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
     * @ORM\Column(type="string", length=255)
     */
    private $apellidos;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=55, nullable=true)
     */
    private $foto;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Horarios", mappedBy="id_alumno")
     */
    private $horarios;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Materias", mappedBy="id_alumno")
     */
    private $materias;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Alumnos", mappedBy="amigos")
     */
    private $alumnos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Calificaciones", mappedBy="alumno")
     */
    private $calificaciones;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Recursos", mappedBy="alumno")
     */
    private $recursos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Recordatorios", mappedBy="alumno")
     */
    private $recordatorios;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="alumno")
     */
    private $users;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Wiki", mappedBy="alumnos")
     */
    private $wikis;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Alumnos", inversedBy="MisAmigos")
     */
    private $amigos;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Alumnos", mappedBy="amigos")
     */
    private $MisAmigos;

    public function __construct()
    {
        $this->horarios = new ArrayCollection();
        $this->materias = new ArrayCollection();
        $this->alumnos = new ArrayCollection();
        $this->calificaciones = new ArrayCollection();
        $this->recursos = new ArrayCollection();
        $this->recordatorios = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->wikis = new ArrayCollection();
        $this->amigos = new ArrayCollection();
        $this->MisAmigos = new ArrayCollection();
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

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(?string $foto): self
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * @return Collection|Horarios[]
     */
    public function getHorarios(): Collection
    {
        return $this->horarios;
    }

    public function addHorario(Horarios $horario): self
    {
        if (!$this->horarios->contains($horario)) {
            $this->horarios[] = $horario;
            $horario->setIdAlumno($this);
        }

        return $this;
    }

    public function removeHorario(Horarios $horario): self
    {
        if ($this->horarios->contains($horario)) {
            $this->horarios->removeElement($horario);
            // set the owning side to null (unless already changed)
            if ($horario->getIdAlumno() === $this) {
                $horario->setIdAlumno(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Materias[]
     */
    public function getMaterias(): Collection
    {
        return $this->materias;
    }

    public function addMateria(Materias $materia): self
    {
        if (!$this->materias->contains($materia)) {
            $this->materias[] = $materia;
            $materia->addIdAlumno($this);
        }

        return $this;
    }

    public function removeMateria(Materias $materia): self
    {
        if ($this->materias->contains($materia)) {
            $this->materias->removeElement($materia);
            $materia->removeIdAlumno($this);
        }

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
            $alumno->addAmigo($this);
        }

        return $this;
    }

    public function removeAlumno(Alumnos $alumno): self
    {
        if ($this->alumnos->contains($alumno)) {
            $this->alumnos->removeElement($alumno);
            $alumno->removeAmigo($this);
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
            $calificacione->setAlumno($this);
        }

        return $this;
    }

    public function removeCalificacione(Calificaciones $calificacione): self
    {
        if ($this->calificaciones->contains($calificacione)) {
            $this->calificaciones->removeElement($calificacione);
            // set the owning side to null (unless already changed)
            if ($calificacione->getAlumno() === $this) {
                $calificacione->setAlumno(null);
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
            $recurso->setAlumno($this);
        }

        return $this;
    }

    public function removeRecurso(Recursos $recurso): self
    {
        if ($this->recursos->contains($recurso)) {
            $this->recursos->removeElement($recurso);
            // set the owning side to null (unless already changed)
            if ($recurso->getAlumno() === $this) {
                $recurso->setAlumno(null);
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
            $recordatorio->setAlumno($this);
        }

        return $this;
    }

    public function removeRecordatorio(Recordatorios $recordatorio): self
    {
        if ($this->recordatorios->contains($recordatorio)) {
            $this->recordatorios->removeElement($recordatorio);
            // set the owning side to null (unless already changed)
            if ($recordatorio->getAlumno() === $this) {
                $recordatorio->setAlumno(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setAlumno($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getAlumno() === $this) {
                $user->setAlumno(null);
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
            $wiki->addAlumno($this);
        }

        return $this;
    }

    public function removeWiki(Wiki $wiki): self
    {
        if ($this->wikis->contains($wiki)) {
            $this->wikis->removeElement($wiki);
            $wiki->removeAlumno($this);
        }

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getAmigos(): Collection
    {
        return $this->amigos;
    }

    public function addAmigo(self $amigo): self
    {
        if (!$this->amigos->contains($amigo)) {
            $this->amigos[] = $amigo;
        }

        return $this;
    }

    public function removeAmigo(self $amigo): self
    {
        if ($this->amigos->contains($amigo)) {
            $this->amigos->removeElement($amigo);
        }

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getMisAmigos(): Collection
    {
        return $this->MisAmigos;
    }

    public function addMisAmigo(self $misAmigo): self
    {
        if (!$this->MisAmigos->contains($misAmigo)) {
            $this->MisAmigos[] = $misAmigo;
            $misAmigo->addAmigo($this);
        }

        return $this;
    }

    public function removeMisAmigo(self $misAmigo): self
    {
        if ($this->MisAmigos->contains($misAmigo)) {
            $this->MisAmigos->removeElement($misAmigo);
            $misAmigo->removeAmigo($this);
        }

        return $this;
    }
}
