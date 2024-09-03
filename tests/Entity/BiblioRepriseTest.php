<?php

namespace App\Tests\Entity;

use App\Entity\BiblioReprise;
use PHPUnit\Framework\TestCase;


class BiblioRepriseTest extends TestCase
{
    public function testGetId(): void
    {
        $biblioReprise = new BiblioReprise();
        $this->assertNull($biblioReprise->getId());
    }

    public function testGetSetReprise(): void
    {
        $biblioReprise = new BiblioReprise();
        $reprise = 'Test Reprise';
        $biblioReprise->setReprise($reprise);
        $this->assertSame($reprise, $biblioReprise->getReprise());
    }

    public function testGetSetDebit(): void
    {
        $biblioReprise = new BiblioReprise();
        $debit = 'Test Debit';
        $biblioReprise->setDebit($debit);
        $this->assertSame($debit, $biblioReprise->getDebit());
    }

    public function testGetSetChemin(): void
    {
        $biblioReprise = new BiblioReprise();
        $chemin = 'Test Chemin';
        $biblioReprise->setChemin($chemin);
        $this->assertSame($chemin, $biblioReprise->getChemin());
    }
}