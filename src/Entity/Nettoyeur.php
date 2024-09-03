<?php

namespace App\Entity;

use App\Repository\NettoyeurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NettoyeurRepository::class)]
class Nettoyeur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $modele = null;

    #[ORM\Column]
    private ?int $grille = null;

    #[ORM\Column(length: 255)]
    private ?string $dechet_leger = null;

    #[ORM\Column(length: 255)]
    private ?string $dechet_mi_lourds = null;

    #[ORM\Column(length: 255)]
    private ?string $dechet_sortie_r = null;

    #[ORM\Column(length: 255)]
    private ?string $sortie_bon_grain = null;

    #[ORM\Column(length: 255)]
    private ?string $type_reprise_nettoyeur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $structure = null;

    /**
     * @var Collection<int, DemandeCommerciale>
     */
    #[ORM\OneToMany(targetEntity: DemandeCommerciale::class, mappedBy: 'nettoyeur')]
    private Collection $demandeCommerciales;

    public function __construct()
    {
        $this->demandeCommerciales = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): static
    {
        $this->modele = $modele;

        return $this;
    }

    public function getGrille(): ?int
    {
        return $this->grille;
    }

    public function setGrille(int $grille): static
    {
        $this->grille = $grille;

        return $this;
    }

    public function getDechetLeger(): ?string
    {
        return $this->dechet_leger;
    }

    public function setDechetLeger(string $dechet_leger): static
    {
        $this->dechet_leger = $dechet_leger;

        return $this;
    }

    public function getDechetMiLourds(): ?string
    {
        return $this->dechet_mi_lourds;
    }

    public function setDechetMiLourds(string $dechet_mi_lourds): static
    {
        $this->dechet_mi_lourds = $dechet_mi_lourds;

        return $this;
    }

    public function getDechetSortieR(): ?string
    {
        return $this->dechet_sortie_r;
    }

    public function setDechetSortieR(string $dechet_sortie_r): static
    {
        $this->dechet_sortie_r = $dechet_sortie_r;

        return $this;
    }

    public function getSortieBonGrain(): ?string
    {
        return $this->sortie_bon_grain;
    }

    public function setSortieBonGrain(string $sortie_bon_grain): static
    {
        $this->sortie_bon_grain = $sortie_bon_grain;

        return $this;
    }

    public function getTypeRepriseNettoyeur(): ?string
    {
        return $this->type_reprise_nettoyeur;
    }

    public function setTypeRepriseNettoyeur(string $type_reprise_nettoyeur): static
    {
        $this->type_reprise_nettoyeur = $type_reprise_nettoyeur;

        return $this;
    }

    public function getStructure(): ?string
    {
        return $this->structure;
    }

    public function setStructure(?string $structure): static
    {
        $this->structure = $structure;

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
            $demandeCommerciale->setNettoyeur($this);
        }

        return $this;
    }

    public function removeDemandeCommerciale(DemandeCommerciale $demandeCommerciale): static
    {
        if ($this->demandeCommerciales->removeElement($demandeCommerciale)) {
            // set the owning side to null (unless already changed)
            if ($demandeCommerciale->getNettoyeur() === $this) {
                $demandeCommerciale->setNettoyeur(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return (string)  $this->id;
    }
}
