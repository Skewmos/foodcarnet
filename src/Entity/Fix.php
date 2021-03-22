<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fix
 *
 * @ORM\Table(name="FIX")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\FixRepository")
 */
class Fix
{
    /**
     * @var int
     *
     * @ORM\Column(name="IDFIX", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idfix;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NAME", type="string", length=255, nullable=true, options={"fixed"=true})
     */
    private $name;

    public function getIdfix(): ?int
    {
        return $this->idfix;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function __toString(){
        // to show the name of the Category in the select
        return $this->name;
        // to show the id of the Category in the select
        // return $this->id;
    }


}
