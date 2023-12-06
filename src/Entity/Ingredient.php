<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\ManyToMany(targetEntity: Allergene::class, inversedBy: 'idIngredient')]
    private Collection $idAllergene;

    #[ORM\ManyToMany(targetEntity: Etape::class, mappedBy: 'idIngredient')]
    private Collection $idEtape;

    public function __construct()
    {
        $this->idAllergene = new ArrayCollection();
        $this->idEtape = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Allergene>
     */
    public function getIdAllergene(): Collection
    {
        return $this->idAllergene;
    }

    public function addIdAllergene(Allergene $idAllergene): static
    {
        if (!$this->idAllergene->contains($idAllergene)) {
            $this->idAllergene->add($idAllergene);
        }

        return $this;
    }

    public function removeIdAllergene(Allergene $idAllergene): static
    {
        $this->idAllergene->removeElement($idAllergene);

        return $this;
    }

    /**
     * @return Collection<int, Etape>
     */
    public function getIdEtape(): Collection
    {
        return $this->idEtape;
    }

    public function addIdEtape(Etape $idEtape): static
    {
        if (!$this->idEtape->contains($idEtape)) {
            $this->idEtape->add($idEtape);
            $idEtape->addIdIngredient($this);
        }

        return $this;
    }

    public function removeIdEtape(Etape $idEtape): static
    {
        if ($this->idEtape->removeElement($idEtape)) {
            $idEtape->removeIdIngredient($this);
        }

        return $this;
    }
}
