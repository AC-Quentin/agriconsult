<?php

namespace App\Entity;

use App\Repository\StockageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StockageRepository::class)]
class Stockage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type_cellule = null;

    #[ORM\Column]
    private ?int $diametre_cellule = null;

    #[ORM\Column]
    private ?int $virole_cellule = null;

    #[ORM\Column(length: 255)]
    private ?string $type_plancher = null;

    #[ORM\Column(length: 255)]
    private ?string $type_reprise = null;

    #[ORM\Column(length: 255)]
    private ?string $debit_reprise = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $option_toit = null;

    #[ORM\Column(length: 255)]
    private ?string $option_porte = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sonde_niveau = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $thermometrie = null;

    #[ORM\Column(length: 255)]
    private ?string $ventilateur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $acces_mur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $acces_toit = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bac_entre_cellule = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $plateforme_toit = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $passerelle = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $vis_mobile = null;

    #[ORM\Column]
    private ?int $quantite = null;

    /**
     * @var Collection<int, DemandeCommerciale>
     */
    #[ORM\OneToMany(targetEntity: DemandeCommerciale::class, mappedBy: 'stockage')]
    private Collection $demandeCommerciales;

    public function __construct()
    {
        $this->demandeCommerciales = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeCellule(): ?string
    {
        return $this->type_cellule;
    }

    public function setTypeCellule(string $type_cellule): static
    {
        $this->type_cellule = $type_cellule;

        return $this;
    }

    public function getDiametreCellule(): ?int
    {
        return $this->diametre_cellule;
    }

    public function setDiametreCellule(int $diametre_cellule): static
    {
        $this->diametre_cellule = $diametre_cellule;

        return $this;
    }

    public function getViroleCellule(): ?int
    {
        return $this->virole_cellule;
    }

    public function setViroleCellule(int $virole_cellule): static
    {
        $this->virole_cellule = $virole_cellule;

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

    public function getOptionToit(): ?string
    {
        return $this->option_toit;
    }

    public function setOptionToit(?string $option_toit): static
    {
        $this->option_toit = $option_toit;

        return $this;
    }

    public function getOptionPorte(): ?string
    {
        return $this->option_porte;
    }

    public function setOptionPorte(string $option_porte): static
    {
        $this->option_porte = $option_porte;

        return $this;
    }

    public function getSondeNiveau(): ?string
    {
        return $this->sonde_niveau;
    }

    public function setSondeNiveau(?string $sonde_niveau): static
    {
        $this->sonde_niveau = $sonde_niveau;

        return $this;
    }

    public function getThermometrie(): ?string
    {
        return $this->thermometrie;
    }

    public function setThermometrie(?string $thermometrie): static
    {
        $this->thermometrie = $thermometrie;

        return $this;
    }

    public function getVentilateur(): ?string
    {
        return $this->ventilateur;
    }

    public function setVentilateur(string $ventilateur): static
    {
        $this->ventilateur = $ventilateur;

        return $this;
    }

    public function getAccesMur(): ?string
    {
        return $this->acces_mur;
    }

    public function setAccesMur(?string $acces_mur): static
    {
        $this->acces_mur = $acces_mur;

        return $this;
    }

    public function getAccesToit(): ?string
    {
        return $this->acces_toit;
    }

    public function setAccesToit(?string $acces_toit): static
    {
        $this->acces_toit = $acces_toit;

        return $this;
    }

    public function getBacEntreCellule(): ?string
    {
        return $this->bac_entre_cellule;
    }

    public function setBacEntreCellule(?string $bac_entre_cellule): static
    {
        $this->bac_entre_cellule = $bac_entre_cellule;

        return $this;
    }

    public function getPlateformeToit(): ?string
    {
        return $this->plateforme_toit;
    }

    public function setPlateformeToit(?string $plateforme_toit): static
    {
        $this->plateforme_toit = $plateforme_toit;

        return $this;
    }

    public function getPasserelle(): ?string
    {
        return $this->passerelle;
    }

    public function setPasserelle(?string $passerelle): static
    {
        $this->passerelle = $passerelle;

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

    public function getVisMobile(): ?string
    {
        return $this->vis_mobile;
    }

    public function setVisMobile(?string $vis_mobile): static
    {
        $this->vis_mobile = $vis_mobile;

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
            $demandeCommerciale->setStockage($this);
        }

        return $this;
    }

    public function removeDemandeCommerciale(DemandeCommerciale $demandeCommerciale): static
    {
        if ($this->demandeCommerciales->removeElement($demandeCommerciale)) {
            // set the owning side to null (unless already changed)
            if ($demandeCommerciale->getStockage() === $this) {
                $demandeCommerciale->setStockage(null);
            }
        }

        return $this;
    }
}
