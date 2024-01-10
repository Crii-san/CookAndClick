<?php

namespace App\Entity;

use App\Repository\RecetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RecetteRepository::class)]
class Recette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: false)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Le nom de la recette doit faire au minimum {{ limit }} caractères',
        maxMessage: 'Le nom de la recette doit faire au maximum {{ limit }} caractères',
    )]
    private ?string $nom = null;

    #[ORM\Column(length: 50, nullable: false)]
    #[Assert\NotBlank]
    #[Assert\Positive]
    #[Assert\LessThanOrEqual(
        value: 5,
    )]
    private ?int $nivDifficulte = null;

    #[ORM\Column(length: 500, nullable: false)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'La desciption de la recette doit faire au minimum {{ limit }} caractères',
        maxMessage: 'La description de la recette doit faire au maximum {{ limit }} caractères',
    )]
    private ?string $description = null;

    #[ORM\Column(nullable: false)]
    #[Assert\NotBlank]
    #[Assert\Positive]
    #[Assert\LessThanOrEqual(
        value: 50,
    )]
    private ?int $nbPersonne = null;

    #[ORM\Column(nullable: false)]
    #[Assert\NotBlank]
    #[Assert\PositiveOrZero]
    #[Assert\LessThan(
        value: 90,
    )]
    private ?int $minutes = null;

    #[ORM\Column(nullable: false)]
    #[Assert\NotBlank]
    #[Assert\PositiveOrZero]
    #[Assert\LessThan(
        value: 24,
    )]
    private ?int $heures = null;

    #[ORM\ManyToOne(inversedBy: 'recettes')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank]
    private ?Categorie $categorie = null;

    #[ORM\OneToMany(mappedBy: 'recette', targetEntity: Etape::class)]
    private Collection $etapes;

    public function __construct()
    {
        $this->etapes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getNivDifficulte(): ?int
    {
        return $this->nivDifficulte;
    }

    public function setNivDifficulte(?int $nivDifficulte): static
    {
        $this->nivDifficulte = $nivDifficulte;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

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

    public function getMinutes(): ?int
    {
        return $this->minutes;
    }

    public function setMinutes(?int $minutes): static
    {
        $this->minutes = $minutes;

        return $this;
    }

    public function getHeures(): ?int
    {
        return $this->heures;
    }

    public function setHeures(?int $heures): static
    {
        $this->heures = $heures;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, Etape>
     */
    public function getEtapes(): Collection
    {
        return $this->etapes;
    }

    public function addEtape(Etape $etape): static
    {
        if (!$this->etapes->contains($etape)) {
            $this->etapes->add($etape);
            $etape->setRecette($this);
        }

        return $this;
    }

    public function removeEtape(Etape $etape): static
    {
        if ($this->etapes->removeElement($etape)) {
            // set the owning side to null (unless already changed)
            if ($etape->getRecette() === $this) {
                $etape->setRecette(null);
            }
        }

        return $this;
    }
}
