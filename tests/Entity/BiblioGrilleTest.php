<?php

namespace App\Tests\Entity;

use App\Entity\BiblioGrille;
use PHPUnit\Framework\TestCase;


class BiblioGrilleTest extends TestCase
{
    public function testGetId(): void
    {
        $biblioGrille = new BiblioGrille();
        $this->assertNull($biblioGrille->getId());
    }

    public function testGetSetGrille(): void
    {
        $biblioGrille = new BiblioGrille();
        $grille = 'Sample grille';

        $biblioGrille->setGrille($grille);
        $this->assertSame($grille, $biblioGrille->getGrille());
    }

    public function testGetSetChemin(): void
    {
        $biblioGrille = new BiblioGrille();
        $chemin = 'Sample chemin';

        $biblioGrille->setChemin($chemin);
        $this->assertSame($chemin, $biblioGrille->getChemin());
    }
}