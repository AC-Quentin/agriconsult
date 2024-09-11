<?php

namespace App\Entity;

use App\Repository\SechoirRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SechoirRepository::class)]
class Sechoir
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $tremie = null;

    #[ORM\Column(length: 255)]
    private ?string $modele = null;

    #[ORM\Column(length: 255)]
    private ?string $energie = null;

    #[ORM\Column(length: 255)]
    private ?string $charpente = null;

    #[ORM\Column(length: 255)]
    private ?string $acces_exterieur = null;

    #[ORM\Column(length: 255)]
    private ?string $acces_interieur = null;

    #[ORM\Column(length: 255)]
    private ?string $option_volet = null;

    #[ORM\Column(length: 255)]
    private ?string $option_vigi_incendie = null;

    #[ORM\Column(length: 255)]
    private ?string $option_grande_porte = null;

    #[ORM\Column(length: 255)]
    private ?string $option_lot_electrique = null;

    #[ORM\Column(length: 255)]
    private ?string $option_nettoyeur = null;

    #[ORM\Column(length: 255)]
    private ?string $option_filtration = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type_tampon = null;

    #[ORM\Column(nullable: true)]
    private ?int $diametre_tampon = null;

    #[ORM\Column(nullable: true)]
    private ?int $pente_cone = null;

    #[ORM\Column(nullable: true)]
    private ?int $virole_tampon = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $trappe_sortie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type_reprise = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $debit_reprise = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $option_toit = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sonde_niveau = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $thermometrie = null;

    #[ORM\Column]
    private ?int $quantite = null;

    /**
     * @var Collection<int, DemandeCommerciale>
     */
    #[ORM\OneToMany(targetEntity: DemandeCommerciale::class, mappedBy: 'sechoir')]
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

    public function getTremie(): ?string
    {
        return $this->tremie;
    }

    public function setTremie(string $tremie): static
    {
        $this->tremie = $tremie;

        return $this;
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

    public function getEnergie(): ?string
    {
        return $this->energie;
    }

    public function setEnergie(string $energie): static
    {
        $this->energie = $energie;

        return $this;
    }

    public function getCharpente(): ?string
    {
        return $this->charpente;
    }

    public function setCharpente(string $charpente): static
    {
        $this->charpente = $charpente;

        return $this;
    }

    public function getAccesExterieur(): ?string
    {
        return $this->acces_exterieur;
    }

    public function setAccesExterieur(string $acces_exterieur): static
    {
        $this->acces_exterieur = $acces_exterieur;

        return $this;
    }

    public function getAccesInterieur(): ?string
    {
        return $this->acces_interieur;
    }

    public function setAccesInterieur(string $acces_interieur): static
    {
        $this->acces_interieur = $acces_interieur;

        return $this;
    }

    public function getOptionVolet(): ?string
    {
        return $this->option_volet;
    }

    public function setOptionVolet(string $option_volet): static
    {
        $this->option_volet = $option_volet;

        return $this;
    }

    public function getOptionVigiIncendie(): ?string
    {
        return $this->option_vigi_incendie;
    }

    public function setOptionVigiIncendie(string $option_vigi_incendie): static
    {
        $this->option_vigi_incendie = $option_vigi_incendie;

        return $this;
    }

    public function getOptionGrandePorte(): ?string
    {
        return $this->option_grande_porte;
    }

    public function setOptionGrandePorte(string $option_grande_porte): static
    {
        $this->option_grande_porte = $option_grande_porte;

        return $this;
    }

    public function getOptionLotElectrique(): ?string
    {
        return $this->option_lot_electrique;
    }

    public function setOptionLotElectrique(string $option_lot_electrique): static
    {
        $this->option_lot_electrique = $option_lot_electrique;

        return $this;
    }

    public function getOptionNettoyeur(): ?string
    {
        return $this->option_nettoyeur;
    }

    public function setOptionNettoyeur(string $option_nettoyeur): static
    {
        $this->option_nettoyeur = $option_nettoyeur;

        return $this;
    }

    public function getOptionFiltration(): ?string
    {
        return $this->option_filtration;
    }

    public function setOptionFiltration(string $option_filtration): static
    {
        $this->option_filtration = $option_filtration;

        return $this;
    }

    public function getTypeTampon(): ?string
    {
        return $this->type_tampon;
    }

    public function setTypeTampon(?string $type_tampon): static
    {
        $this->type_tampon = $type_tampon;

        return $this;
    }

    public function getDiametreTampon(): ?int
    {
        return $this->diametre_tampon;
    }

    public function setDiametreTampon(?int $diametre_tampon): static
    {
        $this->diametre_tampon = $diametre_tampon;

        return $this;
    }

    public function getPenteCone(): ?int
    {
        return $this->pente_cone;
    }

    public function setPenteCone(?int $pente_cone): static
    {
        $this->pente_cone = $pente_cone;

        return $this;
    }

    public function getViroleTampon(): ?int
    {
        return $this->virole_tampon;
    }

    public function setViroleTampon(?int $virole_tampon): static
    {
        $this->virole_tampon = $virole_tampon;

        return $this;
    }

    public function getTrappeSortie(): ?string
    {
        return $this->trappe_sortie;
    }

    public function setTrappeSortie(?string $trappe_sortie): static
    {
        $this->trappe_sortie = $trappe_sortie;

        return $this;
    }

    public function getTypeReprise(): ?string
    {
        return $this->type_reprise;
    }

    public function setTypeReprise(?string $type_reprise): static
    {
        $this->type_reprise = $type_reprise;

        return $this;
    }

    public function getDebitReprise(): ?string
    {
        return $this->debit_reprise;
    }

    public function setDebitReprise(?string $debit_reprise): static
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
            $demandeCommerciale->setSechoir($this);
        }

        return $this;
    }

    public function removeDemandeCommerciale(DemandeCommerciale $demandeCommerciale): static
    {
        if ($this->demandeCommerciales->removeElement($demandeCommerciale)) {
            // set the owning side to null (unless already changed)
            if ($demandeCommerciale->getSechoir() === $this) {
                $demandeCommerciale->setSechoir(null);
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
