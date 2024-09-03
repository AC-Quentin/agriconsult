<?php

namespace App\Tests\Entity;

use App\Entity\Nettoyeur;
use App\Entity\DemandeCommerciale;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

class NettoyeurTest extends TestCase
{
    public function testGetId()
    {
        $nettoyeur = new Nettoyeur();

        $reflection = new \ReflectionClass($nettoyeur);
        $property = $reflection->getProperty('id');
        $property->setAccessible(true);
        $property->setValue($nettoyeur, 1);

        $this->assertEquals(1, $nettoyeur->getId());
    }

    public function testSetAndGetModele()
    {
        $nettoyeur = new Nettoyeur();
        $nettoyeur->setModele('ModeleTest');
        $this->assertEquals('ModeleTest', $nettoyeur->getModele());
    }

    public function testSetAndGetGrille()
    {
        $nettoyeur = new Nettoyeur();
        $nettoyeur->setGrille(123);
        $this->assertEquals(123, $nettoyeur->getGrille());
    }

    public function testSetAndGetDechetLeger()
    {
        $nettoyeur = new Nettoyeur();
        $nettoyeur->setDechetLeger('DechetLegerTest');
        $this->assertEquals('DechetLegerTest', $nettoyeur->getDechetLeger());
    }

    public function testSetAndGetDechetMiLourds()
    {
        $nettoyeur = new Nettoyeur();
        $nettoyeur->setDechetMiLourds('DechetMiLourdsTest');
        $this->assertEquals('DechetMiLourdsTest', $nettoyeur->getDechetMiLourds());
    }

    public function testSetAndGetDechetSortieR()
    {
        $nettoyeur = new Nettoyeur();
        $nettoyeur->setDechetSortieR('DechetSortieRTest');
        $this->assertEquals('DechetSortieRTest', $nettoyeur->getDechetSortieR());
    }

    public function testSetAndGetSortieBonGrain()
    {
        $nettoyeur = new Nettoyeur();
        $nettoyeur->setSortieBonGrain('SortieBonGrainTest');
        $this->assertEquals('SortieBonGrainTest', $nettoyeur->getSortieBonGrain());
    }

    public function testSetAndGetTypeRepriseNettoyeur()
    {
        $nettoyeur = new Nettoyeur();
        $nettoyeur->setTypeRepriseNettoyeur('TypeRepriseTest');
        $this->assertEquals('TypeRepriseTest', $nettoyeur->getTypeRepriseNettoyeur());
    }

    public function testSetAndGetStructure()
    {
        $nettoyeur = new Nettoyeur();
        $nettoyeur->setStructure('StructureTest');
        $this->assertEquals('StructureTest', $nettoyeur->getStructure());
    }

    public function testGetDemandeCommerciales()
    {
        $nettoyeur = new Nettoyeur();
        $this->assertInstanceOf(Collection::class, $nettoyeur->getDemandeCommerciales());
        $this->assertCount(0, $nettoyeur->getDemandeCommerciales());
    }

    public function testAddAndRemoveDemandeCommerciale()
    {
        $nettoyeur = new Nettoyeur();
        $demande = new DemandeCommerciale();

        $nettoyeur->addDemandeCommerciale($demande);
        $this->assertCount(1, $nettoyeur->getDemandeCommerciales());
        $this->assertTrue($nettoyeur->getDemandeCommerciales()->contains($demande));

        $nettoyeur->removeDemandeCommerciale($demande);
        $this->assertCount(0, $nettoyeur->getDemandeCommerciales());
        $this->assertFalse($nettoyeur->getDemandeCommerciales()->contains($demande));
    }
}
