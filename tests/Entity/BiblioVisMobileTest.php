<?php

namespace App\Tests\Entity;

use App\Entity\BiblioVisMobile;
use PHPUnit\Framework\TestCase;


class BiblioVisMobileTest extends TestCase
{
    public function testGetId(): void
    {
        $biblioVisMobile = new BiblioVisMobile();
        $this->assertNull($biblioVisMobile->getId());
    }

    public function testGetSetVis(): void
    {
        $biblioVisMobile = new BiblioVisMobile();
        $vis = 'test_vis';
        $biblioVisMobile->setVis($vis);
        $this->assertSame($vis, $biblioVisMobile->getVis());
    }

    public function testGetSetChemin(): void
    {
        $biblioVisMobile = new BiblioVisMobile();
        $chemin = 'test_chemin';
        $biblioVisMobile->setChemin($chemin);
        $this->assertSame($chemin, $biblioVisMobile->getChemin());
    }
}