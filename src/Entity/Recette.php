<?php

namespace App\Entity;

use App\Repository\RecetteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecetteRepository::class)]
class Recette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idRecette = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $nomRecette = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $typeRecette = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $nivDifficulte = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $descriptionRecette = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbPersonne = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $duree = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Administrateur $Administrateur = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $Utilisateur = null;

    public function getIdRecette(): ?int
    {
        return $this->idRecette;
    }

    public function getNomRecette(): ?string
    {
        return $this->nomRecette;
    }

    public function setNomRecette(?string $nomRecette): static
    {
        $this->nomRecette = $nomRecette;

        return $this;
    }

    public function getTypeRecette(): ?string
    {
        return $this->typeRecette;
    }

    public function setTypeRecette(?string $typeRecette): static
    {
        $this->typeRecette = $typeRecette;

        return $this;
    }

    public function getNivDifficulte(): ?string
    {
        return $this->nivDifficulte;
    }

    public function setNivDifficulte(?string $nivDifficulte): static
    {
        $this->nivDifficulte = $nivDifficulte;

        return $this;
    }

    public function getDescriptionRecette(): ?string
    {
        return $this->descriptionRecette;
    }

    public function setDescriptionRecette(?string $descriptionRecette): static
    {
        $this->descriptionRecette = $descriptionRecette;

        return $this;
    }

    public function getNbPersonne(): ?int
    {
        return $this->nbPersonne;
    }

    public function setNbPersonne(?int $nbPersonne): static
    {
        $this->nbPersonne = $nbPersonne;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(?string $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    public function getAdministrateur(): ?Administrateur
    {
        return $this->Administrateur;
    }

    public function setAdministrateur(?Administrateur $Administrateur): static
    {
        $this->Administrateur = $Administrateur;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->Utilisateur;
    }

    public function setUtilisateur(?Utilisateur $Utilisateur): static
    {
        $this->Utilisateur = $Utilisateur;

        return $this;
    }
}
