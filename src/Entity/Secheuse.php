<?php

namespace App\Entity;

use App\Repository\SecheuseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SecheuseRepository::class)]
class Secheuse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $type_secheuse = null;

    #[ORM\Column(length: 255)]
    private ?string $type_plancher = null;

    #[ORM\Column(length: 255)]
    private ?string $type_reprise = null;

    #[ORM\Column(length: 255)]
    private ?string $debit_reprise = null;

    #[ORM\Column(nullable: true)]
    private ?int $type_module = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $gaz = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $biomasse = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $vis_brassage = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prenettoyeur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $b2d = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $vis_mobile = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $vis_mobile_bac = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $vis_mobile_sortie_orientable = null;

    #[ORM\Column]
    private ?int $quantite = null;

    /**
     * @var Collection<int, DemandeCommerciale>
     */
    #[ORM\OneToMany(targetEntity: DemandeCommerciale::class, mappedBy: 'secheuse')]
    private Collection $demandeCommerciales;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $commentaire = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $debit_vis = null;

    public function __construct()
    {
        $this->demandeCommerciales = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeSecheuse(): ?int
    {
        return $this->type_secheuse;
    }

    public function setTypeSecheuse(int $type_secheuse): static
    {
        $this->type_secheuse = $type_secheuse;

        return $this;
    }

    public function getTypePlancher(): ?string
    {
        return $this->type_plancher;
    }

    public function setTypePlancher(string $type_plancher): static
    {
        $this->type_plancher = $type_plancher;

        return $this;
    }

    public function getTypeReprise(): ?string
    {
        return $this->type_reprise;
    }

    public function setTypeReprise(string $type_reprise): static
    {
        $this->type_reprise = $type_reprise;

        return $this;
    }

    public function getDebitReprise(): ?string
    {
        return $this->debit_reprise;
    }

    public function setDebitReprise(string $debit_reprise): static
    {
        $this->debit_reprise = $debit_reprise;

        return $this;
    }

    public function getTypeModule(): ?int
    {
        return $this->type_module;
    }

    public function setTypeModule(?int $type_module): static
    {
        $this->type_module = $type_module;

        return $this;
    }

    public function getGaz(): ?string
    {
        return $this->gaz;
    }

    public function setGaz(?string $gaz): static
    {
        $this->gaz = $gaz;

        return $this;
    }

    public function getBiomasse(): ?string
    {
        return $this->biomasse;
    }

    public function setBiomasse(?string $biomasse): static
    {
        $this->biomasse = $biomasse;

        return $this;
    }

    public function getVisBrassage(): ?string
    {
        return $this->vis_brassage;
    }

    public function setVisBrassage(?string $vis_brassage): static
    {
        $this->vis_brassage = $vis_brassage;

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

    public function getB2d(): ?string
    {
        return $this->b2d;
    }

    public function setB2d(?string $b2d): static
    {
        $this->b2d = $b2d;

        return $this;
    }

    public function getVisMobile(): ?string
    {
        return $this->vis_mobile;
    }

    public function setVisMobile(?string $vis_mobile): static
    {
        $this->vis_mobile = $vis_mobile;

        return $this;
    }

    public function getVisMobileBac(): ?string
    {
        return $this->vis_mobile_bac;
    }

    public function setVisMobileBac(?string $vis_mobile_bac): static
    {
        $this->vis_mobile_bac = $vis_mobile_bac;

        return $this;
    }

    public function getVisMobileSortieOrientable(): ?string
    {
        return $this->vis_mobile_sortie_orientable;
    }

    public function setVisMobileSortieOrientable(?string $vis_mobile_sortie_orientable): static
    {
        $this->vis_mobile_sortie_orientable = $vis_mobile_sortie_orientable;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

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
            $demandeCommerciale->setSecheuse($this);
        }

        return $this;
    }

    public function removeDemandeCommerciale(DemandeCommerciale $demandeCommerciale): static
    {
        if ($this->demandeCommerciales->removeElement($demandeCommerciale)) {
            // set the owning side to null (unless already changed)
            if ($demandeCommerciale->getSecheuse() === $this) {
                $demandeCommerciale->setSecheuse(null);
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

    public function getDebitVis(): ?string
    {
        return $this->debit_vis;
    }

    public function setDebitVis(?string $debit_vis): static
    {
        $this->debit_vis = $debit_vis;

        return $this;
    }
}
