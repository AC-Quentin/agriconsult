<?php

namespace App\Tests\Entity;

use App\Entity\Sechoir;
Use App\Entity\DemandeCommerciale;
use App\Repository\SechoirRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

class SechoirTest extends TestCase
{
    private Sechoir $sechoir;

    protected function setUp(): void
    {
        $this->sechoir = new Sechoir();
    }

    public function testGetId(): void
    {
        $this->assertNull($this->sechoir->getId());
    }

    public function testGetSetTremie(): void
    {
        $tremie = 'Tremie';

        $this->sechoir->setTremie($tremie);

        $this->assertSame($tremie, $this->sechoir->getTremie());
    }

    public function testGetSetModele(): void
    {
        $modele = 'Modele';

        $this->sechoir->setModele($modele);

        $this->assertSame($modele, $this->sechoir->getModele());
    }

    public function testGetSetEnergie(): void
    {
        $energie = 'Energie';

        $this->sechoir->setEnergie($energie);

        $this->assertSame($energie, $this->sechoir->getEnergie());
    }
    
    public function testGetSetCharpente(): void
    {
        $charpente = 'Charpente';

        $this->sechoir->setCharpente($charpente);

        $this->assertSame($charpente, $this->sechoir->getCharpente());
    }

    public function testGetSetAccesExterieur(): void
    {
        $accesExterieur = 'Acces Exterieur';

        $this->sechoir->setAccesExterieur($accesExterieur);

        $this->assertSame($accesExterieur, $this->sechoir->getAccesExterieur());
    }

    public function testGetSetAccesInterieur(): void
    {
        $accesInterieur = 'Acces Interieur';

        $this->sechoir->setAccesInterieur($accesInterieur);

        $this->assertSame($accesInterieur, $this->sechoir->getAccesInterieur());
    }

    public function testGetSetOptionVolet(): void
    {
        $optionVolet = 'Option Volet';

        $this->sechoir->setOptionVolet($optionVolet);

        $this->assertSame($optionVolet, $this->sechoir->getOptionVolet());
    }

    public function testGetSetOptionVigiIncendie(): void
    {
        $optionVigiIncendie = 'Option Vigi Incendie';

        $this->sechoir->setOptionVigiIncendie($optionVigiIncendie);

        $this->assertSame($optionVigiIncendie, $this->sechoir->getOptionVigiIncendie());
    }

    public function testGetSetOptionGrandePorte(): void
    {
        $optionGrandePorte = 'Option Grande Porte';

        $this->sechoir->setOptionGrandePorte($optionGrandePorte);

        $this->assertSame($optionGrandePorte, $this->sechoir->getOptionGrandePorte());
    }

    public function testGetSetOptionLotElectrique(): void
    {
        $optionLotElectrique = 'Option Lot Electrique';

        $this->sechoir->setOptionLotElectrique($optionLotElectrique);

        $this->assertSame($optionLotElectrique, $this->sechoir->getOptionLotElectrique());
    }

    public function testGetSetOptionNettoyeur(): void
    {
        $optionNettoyeur = 'Option Nettoyeur';

        $this->sechoir->setOptionNettoyeur($optionNettoyeur);

        $this->assertSame($optionNettoyeur, $this->sechoir->getOptionNettoyeur());
    }

    public function testGetSetOptionFiltration(): void
    {
        $optionFiltration = 'Option Filtration';

        $this->sechoir->setOptionFiltration($optionFiltration);

        $this->assertSame($optionFiltration, $this->sechoir->getOptionFiltration());
    }

    public function testGetTypeTampon(): void
    {
        $typeTampon = 'Type Tampon';

        $this->sechoir->setTypeTampon($typeTampon);

        $this->assertSame($typeTampon, $this->sechoir->getTypeTampon());
    }

    public function testGetSetDiametreTampon(): void
    {
        $diametreTampon = 10;

        $this->sechoir->setDiametreTampon($diametreTampon);

        $this->assertSame($diametreTampon, $this->sechoir->getDiametreTampon());
    }

    public function testGetSetPenteCone(): void
    {
        $penteCone = 5;

        $this->sechoir->setPenteCone($penteCone);

        $this->assertSame($penteCone, $this->sechoir->getPenteCone());
    }

    public function testGetSetViroleTampon(): void
    {
        $viroleTampon = 3;

        $this->sechoir->setViroleTampon($viroleTampon);

        $this->assertSame($viroleTampon, $this->sechoir->getViroleTampon());
    }

    public function testGetSetTrappeSortie(): void
    {
        $trappeSortie = 'Trappe Sortie';

        $this->sechoir->setTrappeSortie($trappeSortie);

        $this->assertSame($trappeSortie, $this->sechoir->getTrappeSortie());
    }

    public function testGetSetTypeReprise(): void
    {
        $typeReprise = 'Type Reprise';

        $this->sechoir->setTypeReprise($typeReprise);

        $this->assertSame($typeReprise, $this->sechoir->getTypeReprise());
    }

    public function testGetSetDebitReprise(): void
    {
        $debitReprise = 'Debit Reprise';

        $this->sechoir->setDebitReprise($debitReprise);

        $this->assertSame($debitReprise, $this->sechoir->getDebitReprise());
    }

    public function testGetSetOptionToit(): void
    {
        $optionToit = 'Option Toit';

        $this->sechoir->setOptionToit($optionToit);

        $this->assertSame($optionToit, $this->sechoir->getOptionToit());
    }

    public function testGetSetSondeNiveau(): void
    {
        $sondeNiveau = 'Sonde Niveau';

        $this->sechoir->setSondeNiveau($sondeNiveau);

        $this->assertSame($sondeNiveau, $this->sechoir->getSondeNiveau());
    }

    public function testGetSetThermometrie(): void
    {
        $thermometrie = 'Thermometrie';

        $this->sechoir->setThermometrie($thermometrie);

        $this->assertSame($thermometrie, $this->sechoir->getThermometrie());
    }

    public function testGetSetQuantite(): void
    {
        $quantite = 5;

        $this->sechoir->setQuantite($quantite);

        $this->assertSame($quantite, $this->sechoir->getQuantite());
    }

    public function testAddRemoveDemandeCommerciale(): void
    {
        $demandeCommerciale1 = $this->createMock(DemandeCommerciale::class);
        $demandeCommerciale2 = $this->createMock(DemandeCommerciale::class);

        $this->sechoir->addDemandeCommerciale($demandeCommerciale1);
        $this->sechoir->addDemandeCommerciale($demandeCommerciale2);

        $this->sechoir->removeDemandeCommerciale($demandeCommerciale1);

        $demandeCommerciales = $this->sechoir->getDemandeCommerciales();

        $this->assertCount(1, $demandeCommerciales);
        $this->assertFalse($demandeCommerciales->contains($demandeCommerciale1));
        $this->assertTrue($demandeCommerciales->contains($demandeCommerciale2));
    }

    public function testGetDemandeCommerciales(): void
    {
        $demandeCommerciale1 = $this->createMock(DemandeCommerciale::class);
        $demandeCommerciale2 = $this->createMock(DemandeCommerciale::class);

        $this->sechoir->addDemandeCommerciale($demandeCommerciale1);
        $this->sechoir->addDemandeCommerciale($demandeCommerciale2);

        $demandeCommerciales = $this->sechoir->getDemandeCommerciales();

        $this->assertInstanceOf(Collection::class, $demandeCommerciales);
        $this->assertCount(2, $demandeCommerciales);
        $this->assertTrue($demandeCommerciales->contains($demandeCommerciale1));
        $this->assertTrue($demandeCommerciales->contains($demandeCommerciale2));

        $demandeCommerciale1->setSechoir(null);

        $this->assertNull($demandeCommerciale1->getSechoir());
    }

}