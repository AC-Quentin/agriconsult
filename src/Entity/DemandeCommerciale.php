<?php

namespace App\Entity;

use App\Repository\DemandeCommercialeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DemandeCommercialeRepository::class)]
class DemandeCommerciale
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $date = null;

    #[ORM\Column(length: 255)]
    private ?string $typeDemande = null;

    #[ORM\ManyToOne(inversedBy: 'demandeCommerciales')]
    private ?Stockage $stockage = null;

    #[ORM\ManyToOne(inversedBy: 'demandeCommerciales')]
    private ?Secheuse $secheuse = null;

    #[ORM\ManyToOne(inversedBy: 'demandeCommerciales')]
    private ?Sechoir $sechoir = null;

    #[ORM\ManyToOne(inversedBy: 'demandeCommerciales')]
    private ?Nettoyeur $nettoyeur = null;

    #[ORM\ManyToOne(inversedBy: 'demandeCommerciales')]
    private ?Manutention $manutention = null;

    #[ORM\ManyToOne(inversedBy: 'demandeCommerciales')]
    private ?Client $client = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $commentaire = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getTypeDemande(): ?string
    {
        return $this->typeDemande;
    }

    public function setTypeDemande(string $typeDemande): static
    {
        $this->typeDemande = $typeDemande;

        return $this;
    }

    public function getStockage(): ?Stockage
    {
        return $this->stockage;
    }

    public function setStockage(?Stockage $stockage): static
    {
        $this->stockage = $stockage;

        return $this;
    }

    public function getSecheuse(): ?Secheuse
    {
        return $this->secheuse;
    }

    public function setSecheuse(?Secheuse $secheuse): static
    {
        $this->secheuse = $secheuse;

        return $this;
    }

    public function getSechoir(): ?Sechoir
    {
        return $this->sechoir;
    }

    public function setSechoir(?Sechoir $sechoir): static
    {
        $this->sechoir = $sechoir;

        return $this;
    }

    public function getNettoyeur(): ?Nettoyeur
    {
        return $this->nettoyeur;
    }

    public function setNettoyeur(?Nettoyeur $nettoyeur): static
    {
        $this->nettoyeur = $nettoyeur;

        return $this;
    }

    public function getManutention(): ?Manutention
    {
        return $this->manutention;
    }

    public function setManutention(?Manutention $manutention): static
    {
        $this->manutention = $manutention;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }
}
