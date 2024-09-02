<?php

namespace App\Entity;

use App\Repository\BiblioGrilleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BiblioGrilleRepository::class)]
class BiblioGrille
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $grille = null;

    #[ORM\Column(length: 255)]
    private ?string $chemin = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGrille(): ?string
    {
        return $this->grille;
    }

    public function setGrille(string $grille): static
    {
        $this->grille = $grille;

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
