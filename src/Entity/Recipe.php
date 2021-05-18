<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecipeRepository::class)
 */
class Recipe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column (type="string")
     */
    private $snackname;

    /**
     * @ORM\Column (type="string")
     */
    private $image;

    /**
     * @ORM\Column (type="array")
     */
    private $ingredients=[];

    /**
     * @ORM\Column (type="string")
     */
    private $instructions;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSnackname(): ?string
    {
        return $this->snackname;
    }

    public function setSnackname(string $snackname ): self
    {
        $this->snackname=$snackname;
        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image ): self
    {
        $this->image=$image;
        return $this;
    }

    public function getIngredients(): ?array
    {
        return $this->ingredients;
    }

    public function setIngredients(array $ingredients ): self
    {
        $this->ingredients=$ingredients;
        return $this;
    }

    public function getInstructions(): ?string
    {
        return $this->instructions;
    }

    public function setInstructions(string $instructions ): self
    {
        $this->instructions=$instructions;
        return $this;
    }
}
