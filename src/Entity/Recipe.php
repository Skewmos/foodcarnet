<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Recipe
 *
 * @ORM\Table(name="RECIPE", indexes={@ORM\Index(name="I_FK_RECIPE_CATEGORY", columns={"IDCATEGORY"}), @ORM\Index(name="I_FK_RECIPE_FIX", columns={"IDFIX"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\RecipeRepository")
 */
class Recipe
{
    /**
     * @var int
     *
     * @ORM\Column(name="IDRECIPE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrecipe;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NAME", type="string", length=255, nullable=true, options={"fixed"=true})
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="DESCRIPTION", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="TIMETOCOMPLETE", type="time", nullable=true)
     */
    private $timetocomplete;

    /**
     * @var int|null
     *
     * @ORM\Column(name="VIEWNUMBER", type="bigint", nullable=true)
     */
    private $viewnumber;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PRICE", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $price;

    /**
     * @var \Fix
     *
     * @ORM\ManyToOne(targetEntity="Fix")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IDFIX", referencedColumnName="IDFIX")
     * })
     */
    private $idfix;

    /**
     * @var \Category
     *
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IDCATEGORY", referencedColumnName="IDCATEGORY")
     * })
     */
    private $idcategory;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Ingredient", mappedBy="idrecipe")
     */
    private $idingredient;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idingredient = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdrecipe(): ?int
    {
        return $this->idrecipe;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTimetocomplete(): ?\DateTimeInterface
    {
        return $this->timetocomplete;
    }

    public function setTimetocomplete(?\DateTimeInterface $timetocomplete): self
    {
        $this->timetocomplete = $timetocomplete;

        return $this;
    }

    public function getViewnumber(): ?string
    {
        return $this->viewnumber;
    }

    public function setViewnumber(?string $viewnumber): self
    {
        $this->viewnumber = $viewnumber;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getIdfix(): ?Fix
    {
        return $this->idfix;
    }

    public function setIdfix(?Fix $idfix): self
    {
        $this->idfix = $idfix;

        return $this;
    }

    public function getIdcategory(): ?Category
    {
        return $this->idcategory;
    }

    public function setIdcategory(?Category $idcategory): self
    {
        $this->idcategory = $idcategory;

        return $this;
    }

    /**
     * @return Collection|Ingredient[]
     */
    public function getIdingredient(): Collection
    {
        return $this->idingredient;
    }

    public function addIdingredient(Ingredient $idingredient): self
    {
        if (!$this->idingredient->contains($idingredient)) {
            $this->idingredient[] = $idingredient;
            $idingredient->addIdrecipe($this);
        }

        return $this;
    }

    public function removeIdingredient(Ingredient $idingredient): self
    {
        if ($this->idingredient->removeElement($idingredient)) {
            $idingredient->removeIdrecipe($this);
        }

        return $this;
    }

}
