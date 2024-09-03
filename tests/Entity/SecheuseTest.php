<?php

namespace App\Tests\Entity;

use App\Entity\Secheuse;
use App\Entity\DemandeCommerciale;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

class SecheuseTest extends TestCase
{
    public function testGetId()
    {
        $secheuse = new Secheuse();

        $reflection = new \ReflectionClass($secheuse);
        $property = $reflection->getProperty('id');
        $property->setAccessible(true);
        $property->setValue($secheuse, 1);

        $this->assertEquals(1, $secheuse->getId());
    }

    public function testSetAndGetTypeSecheuse()
    {
        $secheuse = new Secheuse();
        $secheuse->setTypeSecheuse(1);
        $this->assertEquals(1, $secheuse->getTypeSecheuse());
    }

    public function testSetAndGetTypePlancher()
    {
        $secheuse = new Secheuse();
        $secheuse->setTypePlancher('PlancherTest');
        $this->assertEquals('PlancherTest', $secheuse->getTypePlancher());
    }

    public function testSetAndGetTypeReprise()
    {
        $secheuse = new Secheuse();
        $secheuse->setTypeReprise('RepriseTest');
        $this->assertEquals('RepriseTest', $secheuse->getTypeReprise());
    }

    public function testSetAndGetDebitReprise()
    {
        $secheuse = new Secheuse();
        $secheuse->setDebitReprise('DebitTest');
        $this->assertEquals('DebitTest', $secheuse->getDebitReprise());
    }

    public function testSetAndGetTypeModule()
    {
        $secheuse = new Secheuse();
        $secheuse->setTypeModule(2);
        $this->assertEquals(2, $secheuse->getTypeModule());
    }

    public function testSetAndGetGaz()
    {
        $secheuse = new Secheuse();
        $secheuse->setGaz('GazTest');
        $this->assertEquals('GazTest', $secheuse->getGaz());
    }

    public function testSetAndGetBiomasse()
    {
        $secheuse = new Secheuse();
        $secheuse->setBiomasse('BiomasseTest');
        $this->assertEquals('BiomasseTest', $secheuse->getBiomasse());
    }

    public function testSetAndGetVisBrassage()
    {
        $secheuse = new Secheuse();
        $secheuse->setVisBrassage('BrassageTest');
        $this->assertEquals('BrassageTest', $secheuse->getVisBrassage());
    }

    public function testSetAndGetPrenettoyeur()
    {
        $secheuse = new Secheuse();
        $secheuse->setPrenettoyeur('PrenettoyeurTest');
        $this->assertEquals('PrenettoyeurTest', $secheuse->getPrenettoyeur());
    }

    public function testSetAndGetB2d()
    {
        $secheuse = new Secheuse();
        $secheuse->setB2d('B2dTest');
        $this->assertEquals('B2dTest', $secheuse->getB2d());
    }

    public function testSetAndGetVisMobile()
    {
        $secheuse = new Secheuse();
        $secheuse->setVisMobile('VisMobileTest');
        $this->assertEquals('VisMobileTest', $secheuse->getVisMobile());
    }

    public function testSetAndGetQuantite()
    {
        $secheuse = new Secheuse();
        $secheuse->setQuantite(5);
        $this->assertEquals(5, $secheuse->getQuantite());
    }

    public function testGetDemandeCommerciales()
    {
        $secheuse = new Secheuse();
        $this->assertInstanceOf(Collection::class, $secheuse->getDemandeCommerciales());
        $this->assertCount(0, $secheuse->getDemandeCommerciales());
    }

    public function testAddAndRemoveDemandeCommerciale()
    {
        $secheuse = new Secheuse();
        $demande = new DemandeCommerciale();

        $secheuse->addDemandeCommerciale($demande);
        $this->assertCount(1, $secheuse->getDemandeCommerciales());
        $this->assertTrue($secheuse->getDemandeCommerciales()->contains($demande));

        $secheuse->removeDemandeCommerciale($demande);
        $this->assertCount(0, $secheuse->getDemandeCommerciales());
        $this->assertFalse($secheuse->getDemandeCommerciales()->contains($demande));
    }
}
