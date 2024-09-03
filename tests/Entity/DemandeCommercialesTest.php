<?php

namespace App\Tests\Entity;

use App\Entity\DemandeCommerciale;
use App\Entity\Stockage;
use App\Entity\Secheuse;
use App\Entity\Sechoir;
use App\Entity\Nettoyeur;
use App\Entity\Manutention;
use App\Entity\Client;
use PHPUnit\Framework\TestCase;

class DemandeCommercialeTest extends TestCase
{
    public function testId(): void
    {
        $demandeCommerciale = new DemandeCommerciale();
        $this->assertNull($demandeCommerciale->getId());
    }

    public function testDate(): void
    {
        $demandeCommerciale = new DemandeCommerciale();
        $date = new \DateTimeImmutable();
        $demandeCommerciale->setDate($date);
        $this->assertSame($date, $demandeCommerciale->getDate());
    }

    public function testTypeDemande(): void
    {
        $demandeCommerciale = new DemandeCommerciale();
        $typeDemande = 'Test Type';
        $demandeCommerciale->setTypeDemande($typeDemande);
        $this->assertSame($typeDemande, $demandeCommerciale->getTypeDemande());
    }

    public function testStockage(): void
    {
        $demandeCommerciale = new DemandeCommerciale();
        $stockage = $this->createMock(Stockage::class);
        $demandeCommerciale->setStockage($stockage);
        $this->assertSame($stockage, $demandeCommerciale->getStockage());
    }

    public function testSecheuse(): void
    {
        $demandeCommerciale = new DemandeCommerciale();
        $secheuse = $this->createMock(Secheuse::class);
        $demandeCommerciale->setSecheuse($secheuse);
        $this->assertSame($secheuse, $demandeCommerciale->getSecheuse());
    }

    public function testSechoir(): void
    {
        $demandeCommerciale = new DemandeCommerciale();
        $sechoir = $this->createMock(Sechoir::class);
        $demandeCommerciale->setSechoir($sechoir);
        $this->assertSame($sechoir, $demandeCommerciale->getSechoir());
    }

    public function testNettoyeur(): void
    {
        $demandeCommerciale = new DemandeCommerciale();
        $nettoyeur = $this->createMock(Nettoyeur::class);
        $demandeCommerciale->setNettoyeur($nettoyeur);
        $this->assertSame($nettoyeur, $demandeCommerciale->getNettoyeur());
    }

    public function testManutention(): void
    {
        $demandeCommerciale = new DemandeCommerciale();
        $manutention = $this->createMock(Manutention::class);
        $demandeCommerciale->setManutention($manutention);
        $this->assertSame($manutention, $demandeCommerciale->getManutention());
    }

    public function testClient(): void
    {
        $demandeCommerciale = new DemandeCommerciale();
        $client = $this->createMock(Client::class);
        $demandeCommerciale->setClient($client);
        $this->assertSame($client, $demandeCommerciale->getClient());
    }
}
