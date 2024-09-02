<?php

namespace App\Entity;

use App\Repository\BiblioRepriseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BiblioRepriseRepository::class)]
class BiblioReprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $reprise = null;

    #[ORM\Column(length: 255)]
    private ?string $debit = null;

    #[ORM\Column(length: 255)]
    private ?string $chemin = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReprise(): ?string
    {
        return $this->reprise;
    }

    public function setReprise(string $reprise): static
    {
        $this->reprise = $reprise;

        return $this;
    }

    public function getDebit(): ?string
    {
        return $this->debit;
    }

    public function setDebit(string $debit): static
    {
        $this->debit = $debit;

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
