<?php

namespace App\Entity;

use App\Repository\EtapeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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


    #[ORM\ManyToOne(inversedBy: 'etapes')]
    #[ORM\JoinColumn(referencedColumnName: 'id', nullable: false)]
    private ?Recette $idRecette = null;

    #[ORM\ManyToMany(targetEntity: Ingredient::class, inversedBy: 'idEtape')]
    private Collection $idIngredient;

    public function __construct()
    {
        $this->idIngredient = new ArrayCollection();
    }

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

    public function getIdRecette(): ?Recette
    {
        return $this->idRecette;
    }

    public function setIdRecette(?Recette $idRecette): static
    {
        $this->idRecette = $idRecette;

        return $this;
    }

    /**
     * @return Collection<int, Ingredient>
     */
    public function getIdIngredient(): Collection
    {
        return $this->idIngredient;
    }

    public function addIdIngredient(Ingredient $idIngredient): static
    {
        if (!$this->idIngredient->contains($idIngredient)) {
            $this->idIngredient->add($idIngredient);
        }

        return $this;
    }

    public function removeIdIngredient(Ingredient $idIngredient): static
    {
        $this->idIngredient->removeElement($idIngredient);

        return $this;
    }
}
