<?php

namespace App\Entity;

use App\Repository\ManutentionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ManutentionRepository::class)]
class Manutention
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $gamme = null;

    #[ORM\Column]
    private ?int $debit_alimentation = null;

    #[ORM\Column]
    private ?int $debit_reprise = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type_vanne = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prenettoyeur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type_bd = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type_grille = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type_tremie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type_transporteur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $capot_fosse = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $capot_puit = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type_expedition = null;

    /**
     * @var Collection<int, DemandeCommerciale>
     */
    #[ORM\OneToMany(targetEntity: DemandeCommerciale::class, mappedBy: 'manutention')]
    private Collection $demandeCommerciales;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $commentaire = null;

    public function __construct()
    {
        $this->demandeCommerciales = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDebitAlimentation(): ?int
    {
        return $this->debit_alimentation;
    }

    public function setDebitAlimentation(int $debit_alimentation): static
    {
        $this->debit_alimentation = $debit_alimentation;

        return $this;
    }

    public function getDebitReprise(): ?int
    {
        return $this->debit_reprise;
    }

    public function setDebitReprise(int $debit_reprise): static
    {
        $this->debit_reprise = $debit_reprise;

        return $this;
    }

    public function getTypeVanne(): ?string
    {
        return $this->type_vanne;
    }

    public function setTypeVanne(?string $type_vanne): static
    {
        $this->type_vanne = $type_vanne;

        return $this;
    }

    public function getPrenettoyeur(): ?string
    {
        return $this->prenettoyeur;
    }

    public function setPrenettoyeur(?string $prenettoyeur): static
    {
        $this->prenettoyeur = $prenettoyeur;

        return $this;
    }

    public function getTypeBd(): ?string
    {
        return $this->type_bd;
    }

    public function setTypeBd(?string $type_bd): static
    {
        $this->type_bd = $type_bd;

        return $this;
    }

    public function getTypeGrille(): ?string
    {
        return $this->type_grille;
    }

    public function setTypeGrille(?string $type_grille): static
    {
        $this->type_grille = $type_grille;

        return $this;
    }

    public function getTypeTremie(): ?string
    {
        return $this->type_tremie;
    }

    public function setTypeTremie(?string $type_tremie): static
    {
        $this->type_tremie = $type_tremie;

        return $this;
    }

    public function getTypeTransporteur(): ?string
    {
        return $this->type_transporteur;
    }

    public function setTypeTransporteur(?string $type_transporteur): static
    {
        $this->type_transporteur = $type_transporteur;

        return $this;
    }

    public function getCapotFosse(): ?string
    {
        return $this->capot_fosse;
    }

    public function setCapotFosse(?string $capot_fosse): static
    {
        $this->capot_fosse = $capot_fosse;

        return $this;
    }

    public function getCapotPuit(): ?string
    {
        return $this->capot_puit;
    }

    public function setCapotPuit(?string $capot_puit): static
    {
        $this->capot_puit = $capot_puit;

        return $this;
    }

    public function getTypeExpedition(): ?string
    {
        return $this->type_expedition;
    }

    public function setTypeExpedition(?string $type_expedition): static
    {
        $this->type_expedition = $type_expedition;

        return $this;
    }

    /**
     * @return Collection<int, DemandeCommerciale>
     */
    public function getDemandeCommerciales(): Collection
    {
        return $this->demandeCommerciales;
    }

    public function addDemandeCommerciale(DemandeCommerciale $demandeCommerciale): static
    {
        if (!$this->demandeCommerciales->contains($demandeCommerciale)) {
            $this->demandeCommerciales->add($demandeCommerciale);
            $demandeCommerciale->setManutention($this);
        }

        return $this;
    }

    public function removeDemandeCommerciale(DemandeCommerciale $demandeCommerciale): static
    {
        if ($this->demandeCommerciales->removeElement($demandeCommerciale)) {
            // set the owning side to null (unless already changed)
            if ($demandeCommerciale->getManutention() === $this) {
                $demandeCommerciale->setManutention(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->id;
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
