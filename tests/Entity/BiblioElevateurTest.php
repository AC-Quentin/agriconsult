<?php

namespace App\Tests\Entity;

use App\Entity\BiblioElevateur;
use PHPUnit\Framework\TestCase;


class BiblioElevateurTest extends TestCase
{
    public function testGetId(): void
    {
        $biblioElevateur = new BiblioElevateur();
        $this->assertNull($biblioElevateur->getId());
    }

    public function testGetSetGamme(): void
    {
        $biblioElevateur = new BiblioElevateur();
        $gamme = 'Test Gamme';
        $biblioElevateur->setGamme($gamme);
        $this->assertSame($gamme, $biblioElevateur->getGamme());
    }

    public function testGetSetDebit(): void
    {
        $biblioElevateur = new BiblioElevateur();
        $debit = 'Test Debit';
        $biblioElevateur->setDebit($debit);
        $this->assertSame($debit, $biblioElevateur->getDebit());
    }

    public function testGetSetChemin(): void
    {
        $biblioElevateur = new BiblioElevateur();
        $chemin = 'Test Chemin';
        $biblioElevateur->setChemin($chemin);
        $this->assertSame($chemin, $biblioElevateur->getChemin());
    }
}