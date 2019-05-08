<?php

/*
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="app_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Alumnos", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $alumno;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    public function getAlumno(): ?Alumnos
    {
        return $this->alumno;
    }

    public function setAlumno(Alumnos $alumno): self
    {
        $this->alumno = $alumno;

        return $this;
    }
}