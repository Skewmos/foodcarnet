<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Ingredient
 *
 * @ORM\Table(name="INGREDIENT")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\IngredientRepository")
 */
class Ingredient
{
    /**
     * @var int
     *
     * @ORM\Column(name="IDINGREDIENT", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idingredient;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NAME", type="string", length=32, nullable=true, options={"fixed"=true})
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Recipe", inversedBy="idingredient")
     * @ORM\JoinTable(name="contains",
     *   joinColumns={
     *     @ORM\JoinColumn(name="IDINGREDIENT", referencedColumnName="IDINGREDIENT")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="IDRECIPE", referencedColumnName="IDRECIPE")
     *   }
     * )
     */
    private $idrecipe;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idrecipe = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdingredient(): ?int
    {
        return $this->idingredient;
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

    /**
     * @return Collection|Recipe[]
     */
    public function getIdrecipe(): Collection
    {
        return $this->idrecipe;
    }

    public function addIdrecipe(Recipe $idrecipe): self
    {
        if (!$this->idrecipe->contains($idrecipe)) {
            $this->idrecipe[] = $idrecipe;
        }

        return $this;
    }

    public function removeIdrecipe(Recipe $idrecipe): self
    {
        $this->idrecipe->removeElement($idrecipe);

        return $this;
    }

    public function __toString(){
        // to show the name of the Category in the select
        return $this->name;
        // to show the id of the Category in the select
        // return $this->id;
    }
}
