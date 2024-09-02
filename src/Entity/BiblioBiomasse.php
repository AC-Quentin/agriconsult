<?php

namespace App\Entity;

use App\Repository\BiblioBiomasseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BiblioBiomasseRepository::class)]
class BiblioBiomasse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $biomasse = null;

    #[ORM\Column(length: 255)]
    private ?string $chemin = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBiomasse(): ?string
    {
        return $this->biomasse;
    }

    public function setBiomasse(string $biomasse): static
    {
        $this->biomasse = $biomasse;

        return $this;
    }

    public function getChemin(): ?string
    {
        return $this->chemin;
    }

    public function setChemin(string $chemin): static
    {
        $this->chemin = $chemin;

        return $this;
    }
}
