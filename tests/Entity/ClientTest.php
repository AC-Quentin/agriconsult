<?php

namespace App\Tests\Entity;

use App\Entity\Client;
use App\Entity\DemandeCommerciale;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{

    private $client;
    private $demandeCommerciale;

    
    public function testGetId()
    {
        $client = new Client();
        $this->assertNull($client->getId());
    }

    public function testSetAndGetIdClient()
    {
        $client = new Client();
        $client->setIdClient('12345');
        $this->assertEquals('12345', $client->getIdClient());
    }

    public function testSetAndGetRaisonSociale()
    {
        $client = new Client();
        $client->setRaisonSociale('Entreprise XYZ');
        $this->assertEquals('Entreprise XYZ', $client->getRaisonSociale());
    }

    public function testSetAndGetAdresse()
    {
        $client = new Client();
        $client->setAdresse('123 Rue de Paris');
        $this->assertEquals('123 Rue de Paris', $client->getAdresse());
    }

    public function testSetAndGetCodePostal()
    {
        $client = new Client();
        $client->setCodePostal('75000');
        $this->assertEquals('75000', $client->getCodePostal());
    }

    public function testSetAndGetVille()
    {
        $client = new Client();
        $client->setVille('Paris');
        $this->assertEquals('Paris', $client->getVille());
    }

    public function testSetAndGetTelephone()
    {
        $client = new Client();
        $client->setTelephone('0123456789');
        $this->assertEquals('0123456789', $client->getTelephone());
    }

    public function testSetAndGetMobile()
    {
        $client = new Client();
        $client->setMobile('0612345678');
        $this->assertEquals('0612345678', $client->getMobile());
    }

    public function testSetAndGetEmail()
    {
        $client = new Client();
        $client->setEmail('contact@entreprise.com');
        $this->assertEquals('contact@entreprise.com', $client->getEmail());
    }

    protected function setUp(): void
    {
        $this->client = new Client();
        $this->demandeCommerciale = new DemandeCommerciale();
    }

    public function testGetDemandeCommerciales()
    {
        $this->assertInstanceOf(ArrayCollection::class, $this->client->getDemandeCommerciales());
    }

    public function testAddDemandeCommerciale()
    {
        $this->client->addDemandeCommerciale($this->demandeCommerciale);
        $this->assertTrue($this->client->getDemandeCommerciales()->contains($this->demandeCommerciale));
        $this->assertSame($this->client, $this->demandeCommerciale->getClient());
    }

    public function testRemoveDemandeCommerciale()
    {
        $this->client->addDemandeCommerciale($this->demandeCommerciale);
        $this->client->removeDemandeCommerciale($this->demandeCommerciale);
        $this->assertFalse($this->client->getDemandeCommerciales()->contains($this->demandeCommerciale));
        $this->assertNull($this->demandeCommerciale->getClient());
    }
}
