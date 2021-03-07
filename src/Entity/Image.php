<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Table(name="IMAGE", indexes={@ORM\Index(name="I_FK_IMAGE_RECIPE", columns={"IDRECIPE"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class Image
{
    /**
     * @var int
     *
     * @ORM\Column(name="IDIMAGE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idimage;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NAME", type="string", length=255, nullable=true, options={"fixed"=true})
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PATH", type="text", length=65535, nullable=true)
     */
    private $path;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ALT", type="text", length=65535, nullable=true)
     */
    private $alt;

    /**
     * @var \Recipe
     *
     * @ORM\ManyToOne(targetEntity="Recipe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IDRECIPE", referencedColumnName="IDRECIPE")
     * })
     */
    private $idrecipe;

    public function getIdimage(): ?int
    {
        return $this->idimage;
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

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(?string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function setAlt(?string $alt): self
    {
        $this->alt = $alt;

        return $this;
    }

    public function getIdrecipe(): ?Recipe
    {
        return $this->idrecipe;
    }

    public function setIdrecipe(?Recipe $idrecipe): self
    {
        $this->idrecipe = $idrecipe;

        return $this;
    }


}
