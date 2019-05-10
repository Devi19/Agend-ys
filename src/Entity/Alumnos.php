<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Alumnos
 *
 * @ORM\Table(name="alumnos", uniqueConstraints={@ORM\UniqueConstraint(name="email", columns={"email"})})
 * @ORM\Entity
 */
class Alumnos implements UserInterface
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
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="string", length=255, nullable=false)
     */
    private $apellidos;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="foto", type="string", length=55, nullable=true)
     */
    private $foto;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="text", length=65535, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=50, nullable=false)
     */
    private $role;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Alumnos", inversedBy="alumnosSource")
     * @ORM\JoinTable(name="alumnos_alumnos",
     *   joinColumns={
     *     @ORM\JoinColumn(name="alumnos_source", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="alumnos_target", referencedColumnName="id")
     *   }
     * )
     */
    private $alumnosTarget;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Materias", mappedBy="alumnos")
     */
    private $materias;

    //LOGIN
    //Necesario implementacion de estos métodos para la autenticación de alumnos

    public function getUsername(){
		return $this->email;
	}
	public function getSalt(){
		return null;
	}
	public function getRoles(){
		return array($this->getRole());
	}
	public function eraseCredentials(){
		
	}	
	//Fin LOGIN


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->alumnosTarget = new \Doctrine\Common\Collections\ArrayCollection();
        $this->materias = new \Doctrine\Common\Collections\ArrayCollection();
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection|Alumnos[]
     */
    public function getAlumnosTarget(): Collection
    {
        return $this->alumnosTarget;
    }

    public function addAlumnosTarget(Alumnos $alumnosTarget): self
    {
        if (!$this->alumnosTarget->contains($alumnosTarget)) {
            $this->alumnosTarget[] = $alumnosTarget;
        }

        return $this;
    }

    public function removeAlumnosTarget(Alumnos $alumnosTarget): self
    {
        if ($this->alumnosTarget->contains($alumnosTarget)) {
            $this->alumnosTarget->removeElement($alumnosTarget);
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
            $materia->addAlumno($this);
        }

        return $this;
    }

    public function removeMateria(Materias $materia): self
    {
        if ($this->materias->contains($materia)) {
            $this->materias->removeElement($materia);
            $materia->removeAlumno($this);
        }

        return $this;
    }

    public function __toString(){
        return $this->nombre;
    }

}
