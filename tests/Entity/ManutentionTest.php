<?php

namespace App\Tests\Entity;

use App\Entity\Manutention;
use App\Entity\DemandeCommerciale;
use PHPUnit\Framework\TestCase;

class ManutentionTest extends TestCase
{
    public function testGetId()
    {
        $manutention = new Manutention();
    
        // Simuler la définition de l'ID pour vérifier la méthode getId()
        $reflection = new \ReflectionClass($manutention);
        $property = $reflection->getProperty('id');
        $property->setAccessible(true);
        $property->setValue($manutention, 1);
    
        // Appeler explicitement getId() pour que le coverage de code le prenne en compte
        $this->assertEquals(1, $manutention->getId());
    }

    public function testSetAndGetGamme()
    {
        $manutention = new Manutention();
        $manutention->setGamme('TestGamme');
        $this->assertEquals('TestGamme', $manutention->getGamme());
    }

    public function testSetAndGetDebitAlimentation()
    {
        $manutention = new Manutention();
        $manutention->setDebitAlimentation(100);
        $this->assertEquals(100, $manutention->getDebitAlimentation());
    }

    public function testSetAndGetDebitReprise()
    {
        $manutention = new Manutention();
        $manutention->setDebitReprise(150);
        $this->assertEquals(150, $manutention->getDebitReprise());
    }

    public function testSetAndGetTypeVanne()
    {
        $manutention = new Manutention();
        $manutention->setTypeVanne('TypeVanneTest');
        $this->assertEquals('TypeVanneTest', $manutention->getTypeVanne());
    }

    public function testSetAndGetPrenettoyeur()
    {
        $manutention = new Manutention();
        $manutention->setPrenettoyeur('PrenettoyeurTest');
        $this->assertEquals('PrenettoyeurTest', $manutention->getPrenettoyeur());
    }

    public function testSetAndGetTypeBd()
    {
        $manutention = new Manutention();
        $manutention->setTypeBd('TypeBdTest');
        $this->assertEquals('TypeBdTest', $manutention->getTypeBd());
    }

    public function testSetAndGetTypeGrille()
    {
        $manutention = new Manutention();
        $manutention->setTypeGrille('TypeGrilleTest');
        $this->assertEquals('TypeGrilleTest', $manutention->getTypeGrille());
    }

    public function testSetAndGetTypeTremie()
    {
        $manutention = new Manutention();
        $manutention->setTypeTremie('TypeTremieTest');
        $this->assertEquals('TypeTremieTest', $manutention->getTypeTremie());
    }

    public function testSetAndGetTypeTransporteur()
    {
        $manutention = new Manutention();
        $manutention->setTypeTransporteur('TypeTransporteurTest');
        $this->assertEquals('TypeTransporteurTest', $manutention->getTypeTransporteur());
    }

    public function testSetAndGetCapotFosse()
    {
        $manutention = new Manutention();
        $manutention->setCapotFosse('CapotFosseTest');
        $this->assertEquals('CapotFosseTest', $manutention->getCapotFosse());
    }

    public function testSetAndGetCapotPuit()
    {
        $manutention = new Manutention();
        $manutention->setCapotPuit('CapotPuitTest');
        $this->assertEquals('CapotPuitTest', $manutention->getCapotPuit());
    }

    public function testSetAndGetTypeExpedition()
    {
        $manutention = new Manutention();
        $manutention->setTypeExpedition('TypeExpeditionTest');
        $this->assertEquals('TypeExpeditionTest', $manutention->getTypeExpedition());
    }

    public function testGetAndAddDemandeCommerciales()
    {
        $manutention = new Manutention();
        $demande = new DemandeCommerciale();
        $manutention->addDemandeCommerciale($demande);

        $this->assertCount(1, $manutention->getDemandeCommerciales());
        $this->assertSame($demande, $manutention->getDemandeCommerciales()[0]);
    }

    public function testRemoveDemandeCommerciale()
    {
        $manutention = new Manutention();
        $demande = new DemandeCommerciale();
        $manutention->addDemandeCommerciale($demande);
        $manutention->removeDemandeCommerciale($demande);

        $this->assertCount(0, $manutention->getDemandeCommerciales());
    }
}
