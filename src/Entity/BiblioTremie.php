<?php

namespace App\Entity;

use App\Repository\BiblioTremieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BiblioTremieRepository::class)]
class BiblioTremie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $tremie = null;

    #[ORM\Column(length: 255)]
    private ?string $gamme = null;

    #[ORM\Column(length: 255)]
    private ?string $transporteur = null;

    #[ORM\Column]
    private ?int $largeur = null;

    #[ORM\Column(length: 255)]
    private ?string $debit = null;

    #[ORM\Column(length: 255)]
    private ?string $chemin = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTremie(): ?string
    {
        return $this->tremie;
    }

    public function setTremie(string $tremie): static
    {
        $this->tremie = $tremie;

        return $this;
    }

    public function getGamme(): ?string
    {
        return $this->gamme;
    }

    public function setGamme(string $gamme): static
    {
        $this->gamme = $gamme;

        return $this;
    }

    public function getTransporteur(): ?string
    {
        return $this->transporteur;
    }

    public function setTransporteur(string $transporteur): static
    {
        $this->transporteur = $transporteur;

        return $this;
    }

    public function getLargeur(): ?int
    {
        return $this->largeur;
    }

    public function setLargeur(int $largeur): static
    {
        $this->largeur = $largeur;

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
