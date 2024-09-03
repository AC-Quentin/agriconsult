<?php

namespace App\Tests\Entity;

use App\Entity\BiblioModule;
use PHPUnit\Framework\TestCase;


class BiblioModuleTest extends TestCase
{
    public function testGetId(): void
    {
        $biblioModule = new BiblioModule();
        $this->assertNull($biblioModule->getId());
    }

    public function testGetSetModule(): void
    {
        $biblioModule = new BiblioModule();
        $module = 'Test Module';
        $biblioModule->setModule($module);
        $this->assertSame($module, $biblioModule->getModule());
    }

    public function testGetSetChemin(): void
    {
        $biblioModule = new BiblioModule();
        $chemin = '/path/to/module';
        $biblioModule->setChemin($chemin);
        $this->assertSame($chemin, $biblioModule->getChemin());
    }
}