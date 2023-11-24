<?php

namespace App\Entity;

use App\Repository\AllergeneRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AllergeneRepository::class)]
class Allergene
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idAllergene = null;

    #[ORM\Column(length: 50)]
    private ?string $nomAllergene = null;

    #[ORM\Column(length: 500)]
    private ?string $descriptionAllergene = null;


    public function getIdAllergene(): ?int
    {
        return $this->idAllergene;
    }

    public function setIdAllergene(int $idAllergene): static
    {
        $this->idAllergene = $idAllergene;

        return $this;
    }

    public function getNomAllergene(): ?string
    {
        return $this->nomAllergene;
    }

    public function setNomAllergene(string $nomAllergene): static
    {
        $this->nomAllergene = $nomAllergene;

        return $this;
    }

    public function getDescriptionAllergene(): ?string
    {
        return $this->descriptionAllergene;
    }

    public function setDescriptionAllergene(string $descriptionAllergene): static
    {
        $this->descriptionAllergene = $descriptionAllergene;

        return $this;
    }
}
