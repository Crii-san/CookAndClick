<?php

namespace App\Entity;

use App\Repository\EtapeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtapeRepository::class)]
class Etape
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idEtape = null;

    #[ORM\Column(nullable: true)]
    private ?int $numeroEtape = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $descriptionEtape = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(referencedColumnName: 'idIngredient', nullable: false)]
    private ?Ingredient $idIngredient = null;

    #[ORM\ManyToOne(inversedBy: 'etapes')]
    #[ORM\JoinColumn(referencedColumnName: 'idRecette', nullable: false)]
    private ?Recette $idRecette = null;

    public function getIdEtape(): ?int
    {
        return $this->idEtape;
    }

    public function getNumeroEtape(): ?int
    {
        return $this->numeroEtape;
    }

    public function setNumeroEtape(?int $numeroEtape): static
    {
        $this->numeroEtape = $numeroEtape;

        return $this;
    }

    public function getDescriptionEtape(): ?string
    {
        return $this->descriptionEtape;
    }

    public function setDescriptionEtape(?string $descriptionEtape): static
    {
        $this->descriptionEtape = $descriptionEtape;

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
