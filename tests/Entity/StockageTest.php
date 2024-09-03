<?php

namespace App\Tests\Entity;

use App\Entity\Stockage;
use App\Entity\DemandeCommerciale;
use PHPUnit\Framework\TestCase;

class StockageTest extends TestCase
{
    public function testGetId(): void
    {
        $stockage = new Stockage();
        $this->assertNull($stockage->getId());
    }

    public function testGetAndSetTypeCellule(): void
    {
        $stockage = new Stockage();
        $typeCellule = 'type_cellule';

        $stockage->setTypeCellule($typeCellule);

        $this->assertSame($typeCellule, $stockage->getTypeCellule());
    }

    public function testGetAndSetDiametreCellule(): void
    {
        $stockage = new Stockage();
        $diametreCellule = 10;

        $stockage->setDiametreCellule($diametreCellule);

        $this->assertSame($diametreCellule, $stockage->getDiametreCellule());
    }

    public function testGetAndSetViroleCellule(): void
    {
        $stockage = new Stockage();
        $viroleCellule = 5;

        $stockage->setViroleCellule($viroleCellule);

        $this->assertSame($viroleCellule, $stockage->getViroleCellule());
    }

    public function testGetAndSetTypePlancher(): void
    {
        $stockage = new Stockage();
        $typePlancher = 'type_plancher';

        $stockage->setTypePlancher($typePlancher);

        $this->assertSame($typePlancher, $stockage->getTypePlancher());
    }

    public function testGetAndSetTypeReprise(): void
    {
        $stockage = new Stockage();
        $typeReprise = 'type_reprise';

        $stockage->setTypeReprise($typeReprise);

        $this->assertSame($typeReprise, $stockage->getTypeReprise());
    }

    public function testGetAndSetDebitReprise(): void
    {
        $stockage = new Stockage();
        $debitReprise = 'debit_reprise';

        $stockage->setDebitReprise($debitReprise);

        $this->assertSame($debitReprise, $stockage->getDebitReprise());
    }

    public function testGetAndSetOptionToit(): void
    {
        $stockage = new Stockage();
        $optionToit = 'option_toit';

        $stockage->setOptionToit($optionToit);

        $this->assertSame($optionToit, $stockage->getOptionToit());
    }

    public function testGetAndSetOptionPorte(): void
    {
        $stockage = new Stockage();
        $optionPorte = 'option_porte';

        $stockage->setOptionPorte($optionPorte);

        $this->assertSame($optionPorte, $stockage->getOptionPorte());
    }

    public function testGetAndSetSondeNiveau(): void
    {
        $stockage = new Stockage();
        $sondeNiveau = 'sonde_niveau';

        $stockage->setSondeNiveau($sondeNiveau);

        $this->assertSame($sondeNiveau, $stockage->getSondeNiveau());
    }

    public function testGetAndSetThermometrie(): void
    {
        $stockage = new Stockage();
        $thermometrie = 'thermometrie';

        $stockage->setThermometrie($thermometrie);

        $this->assertSame($thermometrie, $stockage->getThermometrie());
    }

    public function testGetAndSetVentilateur(): void
    {
        $stockage = new Stockage();
        $ventilateur = 'ventilateur';

        $stockage->setVentilateur($ventilateur);

        $this->assertSame($ventilateur, $stockage->getVentilateur());
    }

    public function testGetAndSetAccesMur(): void
    {
        $stockage = new Stockage();
        $accesMur = 'acces_mur';

        $stockage->setAccesMur($accesMur);

        $this->assertSame($accesMur, $stockage->getAccesMur());
    }

    public function testGetAndSetAccesToit(): void
    {
        $stockage = new Stockage();
        $accesToit = 'acces_toit';

        $stockage->setAccesToit($accesToit);

        $this->assertSame($accesToit, $stockage->getAccesToit());
    }

    public function testGetAndSetBacEntreCellule(): void
    {
        $stockage = new Stockage();
        $bacEntreCellule = 'bac_entre_cellule';

        $stockage->setBacEntreCellule($bacEntreCellule);

        $this->assertSame($bacEntreCellule, $stockage->getBacEntreCellule());
    }

    public function testGetAndSetPlateformeToit(): void
    {
        $stockage = new Stockage();
        $plateformeToit = 'plateforme_toit';

        $stockage->setPlateformeToit($plateformeToit);

        $this->assertSame($plateformeToit, $stockage->getPlateformeToit());
    }

    public function testGetAndSetPasserelle(): void
    {
        $stockage = new Stockage();
        $passerelle = 'passerelle';

        $stockage->setPasserelle($passerelle);

        $this->assertSame($passerelle, $stockage->getPasserelle());
    }

    public function testGetAndSetQuantite(): void
    {
        $stockage = new Stockage();
        $quantite = 10;

        $stockage->setQuantite($quantite);

        $this->assertSame($quantite, $stockage->getQuantite());
    }

    public function testGetAndSetVisMobile(): void
    {
        $stockage = new Stockage();
        $visMobile = 'vis_mobile';

        $stockage->setVisMobile($visMobile);

        $this->assertSame($visMobile, $stockage->getVisMobile());
    }

    public function testAddAndRemoveDemandeCommerciale(): void
    {
        $stockage = new Stockage();
        $demandeCommerciale = new DemandeCommerciale();

        $stockage->addDemandeCommerciale($demandeCommerciale);

        $this->assertTrue($stockage->getDemandeCommerciales()->contains($demandeCommerciale));
        $this->assertSame($stockage, $demandeCommerciale->getStockage());

        $stockage->removeDemandeCommerciale($demandeCommerciale);

        $this->assertFalse($stockage->getDemandeCommerciales()->contains($demandeCommerciale));
        $this->assertNull($demandeCommerciale->getStockage());
    }
}