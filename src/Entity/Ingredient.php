<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
class Ingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idIngredient = null;

    #[ORM\Column(length: 50)]
    private ?string $nomIngredient = null;

    #[ORM\Column]
    private ?int $calories = null;

    #[ORM\Column(length: 50)]
    private ?string $uniteMesure = null;

    #[ORM\Column(length: 500)]
    private ?string $descriptionIngredient = null;

    public function getIdIngredient(): ?int
    {
        return $this->idIngredient;
    }

    public function setIdIngredient(int $idIngredient): static
    {
        $this->idIngredient = $idIngredient;

        return $this;
    }

    public function getNomIngredient(): ?string
    {
        return $this->nomIngredient;
    }

    public function setNomIngredient(string $nomIngredient): static
    {
        $this->nomIngredient = $nomIngredient;

        return $this;
    }

    public function getCalories(): ?int
    {
        return $this->calories;
    }

    public function setCalories(int $calories): static
    {
        $this->calories = $calories;

        return $this;
    }

    public function getUniteMesure(): ?string
    {
        return $this->uniteMesure;
    }

    public function setUniteMesure(string $uniteMesure): static
    {
        $this->uniteMesure = $uniteMesure;

        return $this;
    }

    public function getDescriptionIngredient(): ?string
    {
        return $this->descriptionIngredient;
    }

    public function setDescriptionIngredient(string $descriptionIngredient): static
    {
        $this->descriptionIngredient = $descriptionIngredient;

        return $this;
    }

    public function getNo(): ?string
    {
        return $this->no;
    }

    public function setNo(string $no): static
    {
        $this->no = $no;

        return $this;
    }
}
