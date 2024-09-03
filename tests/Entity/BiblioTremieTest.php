<?php

namespace App\Tests\Entity;

use App\Entity\BiblioTremie;
use PHPUnit\Framework\TestCase;


class BiblioTremieTest extends TestCase
{
    private BiblioTremie $biblioTremie;

    public function testGetId(): void
    {
        $biblioTremie = new BiblioTremie();
        $this->assertNull($biblioTremie->getId());
    }

    protected function setUp(): void
    {
        $this->biblioTremie = new BiblioTremie();
    }

    public function testGetSetTremie(): void
    {
        $test = 'test tremie';

        $this->biblioTremie->setTremie($test);
        $this->assertSame($test, $this->biblioTremie->getTremie());
    }

    public function testGetSetGamme(): void
    {
        $test = 'test gamme';

        $this->biblioTremie->setGamme($test);
        $this->assertSame($test, $this->biblioTremie->getGamme());
    }

    public function testGetSetTransporteur(): void
    {
        $test = 'test transporteur';

        $this->biblioTremie->setTransporteur($test);
        $this->assertSame($test, $this->biblioTremie->getTransporteur());
    }

    public function testGetSetLargeur(): void
    {
        $test = 100;

        $this->biblioTremie->setLargeur($test);
        $this->assertSame($test, $this->biblioTremie->getLargeur());
    }

    public function testGetSetDebit(): void
    {
        $test = 'test debit';

        $this->biblioTremie->setDebit($test);
        $this->assertSame($test, $this->biblioTremie->getDebit());
    }

    public function testGetSetChemin(): void
    {
        $test = 'test chemin';

        $this->biblioTremie->setChemin($test);
        $this->assertSame($test, $this->biblioTremie->getChemin());
    }
}