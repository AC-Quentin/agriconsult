<?php

namespace App\Tests\Entity;

use App\Entity\BiblioTcFosse;
use PHPUnit\Framework\TestCase;


class BiblioTcFosseTest extends TestCase
{
    public function testGetId(): void
    {
        $biblioTcFosse = new BiblioTcFosse();
        $this->assertNull($biblioTcFosse->getId());
    }

    public function testGetSetGamme(): void
    {
        $biblioTcFosse = new BiblioTcFosse();
        $gamme = 'Test Gamme';

        $biblioTcFosse->setGamme($gamme);

        $this->assertSame($gamme, $biblioTcFosse->getGamme());
    }

    public function testGetSetDebit(): void
    {
        $biblioTcFosse = new BiblioTcFosse();
        $debit = 'Test Debit';

        $biblioTcFosse->setDebit($debit);

        $this->assertSame($debit, $biblioTcFosse->getDebit());
    }

    public function testGetSetTransporteur(): void
    {
        $biblioTcFosse = new BiblioTcFosse();
        $transporteur = 'Test Transporteur';

        $biblioTcFosse->setTransporteur($transporteur);

        $this->assertSame($transporteur, $biblioTcFosse->getTransporteur());
    }

    public function testGetSetChemin(): void
    {
        $biblioTcFosse = new BiblioTcFosse();
        $chemin = 'Test Chemin';

        $biblioTcFosse->setChemin($chemin);

        $this->assertSame($chemin, $biblioTcFosse->getChemin());
    }
}