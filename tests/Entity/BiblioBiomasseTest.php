<?php
namespace App\Tests\Entity;

use App\Entity\BiblioBiomasse;
use PHPUnit\Framework\TestCase;

class BiblioBiomasseTest extends TestCase
{

    public function testGetId()
    {
        $biblioBiomasse = new BiblioBiomasse();
        $this->assertNull($biblioBiomasse->getId());
    }

    public function testGetAndSetBiomasse()
    {
        $biblioBiomasse = new BiblioBiomasse();
        $biblioBiomasse->setBiomasse('ExampleBiomasse');
        $this->assertEquals('ExampleBiomasse', $biblioBiomasse->getBiomasse());
    }

    public function testGetAndSetChemin()
    {
        $biblioBiomasse = new BiblioBiomasse();
        $biblioBiomasse->setChemin('ExampleChemin');
        $this->assertEquals('ExampleChemin', $biblioBiomasse->getChemin());
    }
}
