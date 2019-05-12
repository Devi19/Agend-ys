<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ciclos
 *
 * @ORM\Table(name="ciclos")
 * @ORM\Entity
 */
class Ciclos
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
 * @ORM\Column(name="tipo", type="string", length=50, nullable=false)
 */
private $tipo;

public function getId(): ?int
{
return $this->id;
}

public function getTipo(): ?string
{
return $this->tipo;
}

public function setTipo(string $tipo): self
{
$this->tipo = $tipo;

return $this;
}

public function __toString(){
return $this->tipo;
}

}
