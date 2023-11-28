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
    private ?int $quantile = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(referencedColumnName: 'idRecette',nullable: false)]
    private ?Recette $idRecette = null;

    public function getIdDetail(): ?int
    {
        return $this->idDetail;
    }

    public function setIdDetail(int $idDetail): static
    {
        $this->idDetail = $idDetail;

        return $this;
    }

    public function getQuantile(): ?int
    {
        return $this->quantile;
    }

    public function setQuantile(int $quantile): static
    {
        $this->quantile = $quantile;

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
}
