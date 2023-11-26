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
}
