<?php

namespace App\Entity;

use App\Repository\DetailRecetteIngredientRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetailRecetteIngredientRepository::class)]
class DetailRecetteIngredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idDetail = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(referencedColumnName: 'id', nullable: false)]
    private ?Recette $idRecette = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(referencedColumnName: 'idIngredient', nullable: false)]
    private ?Ingredient $idIngredient = null;

    public function getIdDetail(): ?int
    {
        return $this->idDetail;
    }

    public function setIdDetail(int $idDetail): static
    {
        $this->idDetail = $idDetail;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getIdRecette(): ?Recette
    {
        return $this->idRecette;
    }

    public function setIdRecette(?Recette $idRecette): static
    {
        $this->idRecette = $idRecette;

        return $this;
    }

    public function getIdIngredient(): ?Ingredient
    {
        return $this->idIngredient;
    }

    public function setIdIngredient(?Ingredient $idIngredient): static
    {
        $this->idIngredient = $idIngredient;

        return $this;
    }
}
