<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\DemandeCommerciale;
use App\Entity\Manutention;
use App\Entity\Nettoyeur;
use App\Entity\Secheuse;
use App\Entity\Sechoir;
use App\Entity\Stockage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker::create('fr_FR');

        // Create 10 stockages
        $stockages = [];
        for ($i = 0; $i < 10; ++$i) {
            $stockage = new Stockage();

            $stockage
                ->setTypeCellule($faker->randomElement(['SFP', 'SFC']))
                ->setDiametreCellule($faker->numberBetween(3, 20))
                ->setViroleCellule($faker->numberBetween(3, 15))
                ->setTypePlancher($faker->randomElement(['CEREALES', 'COLZA']))
                ->setTypeReprise($faker->randomElement(['VERTICALE', 'HORIZONTALE', 'INCLINE']))
                ->setDebitReprise($faker->randomElement(['60T/h', '100T/h']))
                ->setOptionPorte($faker->randomElement(['OUI', 'NON']))
                ->setOptionToit($faker->randomElement(['OUI', 'NON']))
                ->setSondeNiveau($faker->randomElement(['OUI', 'NON']))
                ->setThermometrie($faker->randomElement(['', 'STD', '1 CABLE']))
                ->setVentilateur($faker->randomElement(['OUI', 'NON']))
                ->setAccesMur($faker->randomElement(['OUI', 'NON']))
                ->setAccesToit($faker->randomElement(['OUI', 'NON']))
                ->setBacEntreCellule($faker->randomElement(['OUI', 'NON']))
                ->setPlateformeToit($faker->randomElement(['OUI', 'NON']))
                ->setPasserelle($faker->randomElement(['OUI', 'NON']))
                ->setVisMobile($faker->randomElement(['', 'SA1060', 'SA1070', 'SA1080']))
                ->setQuantite($faker->numberBetween(1, 4));
            $manager->persist($stockage);

            $stockages[] = $stockage;
        }

        // Create 10 Sécheuse
        $secheuses = [];
        for ($i = 0; $i < 10; ++$i) {
            $secheuse = new Secheuse();

            $secheuse
                    ->setTypeSecheuse($faker->numberBetween(1, 4))
                    ->setTypePlancher($faker->word)
                    ->setTypeReprise($faker->word)
                    ->setDebitReprise($faker->randomElement(['10T/h', '20T/h', '30T/h']))
                    ->setTypeModule($faker->numberBetween(1, 4))
                    ->setGaz($faker->word)
                    ->setBiomasse($faker->word)
                    ->setVisBrassage($faker->word)
                    ->setPrenettoyeur($faker->word)
                    ->setB2d($faker->word)
                    ->setVisMobile($faker->word)
                    ->setQuantite($faker->numberBetween(1, 4));
            $manager->persist($secheuse);

            $secheuses[] = $secheuse;
        }

        // Create 10 Manutention

        $manutentions = [];
        for ($i = 0; $i < 10; ++$i) {
            $manutention = new Manutention();

            $manutention
                ->setGamme($faker->randomElement(['Vis', 'Convoyeur', 'Elevateur']))
                ->setDebitAlimentation($faker->randomElement(['10', '20', '30']))
                ->setDebitReprise($faker->randomElement(['10', '20', '30']))
                ->setTypeVanne($faker->randomElement(['Caoutchouc', 'Chaine', 'Tasseaux']))
                ->setPrenettoyeur($faker->randomElement(['10', '20', '30']))
                ->setTypeBd($faker->randomElement(['Caoutchouc', 'Chaine', 'Tasseaux']))
                ->setTypeGrille($faker->randomElement(['PASSANTE', 'NON PASSANTE']))
                ->setTypeTremie($faker->randomElement(['OUI', 'NON']))
                ->setTypeTransporteur($faker->randomElement(['OUI', 'NON']))
                ->setCapotFosse($faker->randomElement(['OUI', 'NON']))
                ->setCapotPuit($faker->randomElement(['OUI', 'NON']))
                ->setTypeExpedition($faker->randomElement(['OUI', 'NON']));

            $manager->persist($manutention);

            $manutentions[] = $manutention;
        }

        // Create 10 Nettoyeur
        $nettoyeurs = [];
        for ($i = 0; $i < 10; ++$i) {
            $nettoyeur = new Nettoyeur();

            $nettoyeur
                    ->setModele($faker->word)
                    ->setGrille($faker->numberBetween(1, 10))
                    ->setDechetLeger($faker->word)
                    ->setDechetMiLourds($faker->word)
                    ->setDechetSortieR($faker->word)
                    ->setSortieBonGrain($faker->word)
                    ->setTypeRepriseNettoyeur($faker->word)
                    ->setStructure($faker->word);
            $manager->persist($nettoyeur);

            $nettoyeurs[] = $nettoyeur;
        }

        // Create 10 Sechoir
        $sechoirs = [];
        for ($i = 0; $i < 10; ++$i) {
            $sechoir = new Sechoir();

            $sechoir
                ->setTremie($faker->randomElement(['OUI', 'NON']))
                ->setModele($faker->word)
                ->setEnergie($faker->word)
                ->setCharpente($faker->word)
                ->setAccesExterieur($faker->word)
                ->setAccesInterieur($faker->word)
                ->setOptionVolet($faker->randomElement(['OUI', 'NON']))
                ->setOptionVigiIncendie($faker->randomElement(['OUI', 'NON']))
                ->setOptionGrandePorte($faker->randomElement(['OUI', 'NON']))
                ->setOptionLotElectrique($faker->randomElement(['OUI', 'NON']))
                ->setOptionNettoyeur($faker->randomElement(['OUI', 'NON']))
                ->setOptionFiltration($faker->randomElement(['OUI', 'NON']))
                ->setTypeTampon($faker->randomElement(['', 'Type 1', 'Type 2']))
                ->setDiametreTampon($faker->numberBetween(1, 10))
                ->setPenteCone($faker->numberBetween(1, 10))
                ->setViroleTampon($faker->numberBetween(1, 10))
                ->setTrappeSortie($faker->randomElement(['', 'Trappe 1', 'Trappe 2']))
                ->setTypeReprise($faker->randomElement(['', 'Reprise 1', 'Reprise 2']))
                ->setDebitReprise($faker->randomElement(['', '10T/h', '20T/h', '30T/h']))
                ->setOptionToit($faker->randomElement(['', 'OUI', 'NON']))
                ->setSondeNiveau($faker->randomElement(['', 'OUI', 'NON']))
                ->setThermometrie($faker->randomElement(['', 'STD', '1 CABLE']))
                ->setQuantite($faker->numberBetween(1, 4));
            $manager->persist($sechoir);

            $sechoirs[] = $sechoir;
        }

        // Create 10 Client
        $clients = [];
        for ($i = 0; $i < 10; ++$i) {
            $client = new Client();

            $client
                ->setIdClient($faker->word)
                ->setRaisonSociale($faker->company)
                ->setAdresse($faker->address)
                ->setCodePostal($faker->postcode)
                ->setVille($faker->city)
                ->setTelephone($faker->phoneNumber)
                ->setMobile($faker->phoneNumber)
                ->setEmail($faker->email);
            $manager->persist($client);

            $clients[] = $client;
        }

        // Create 10 Demande Commerciale
        $demandeCommerciales = [];
        for ($i = 0; $i < 10; ++$i) {
            $demandeCommerciale = new DemandeCommerciale();
            $date = \DateTimeImmutable::createFromMutable($faker->dateTime);

            $demandeCommerciale
                ->setDate($date)
                ->setTypeDemande($faker->word)
                ->setClient($faker->randomElement($clients))
                ->setStockage($faker->randomElement($stockages))
                ->setSecheuse($faker->randomElement($secheuses))
                ->setManutention($faker->randomElement($manutentions))
                ->setNettoyeur($faker->randomElement($nettoyeurs))
                ->setSechoir($faker->randomElement($sechoirs));
            $manager->persist($demandeCommerciale);

            $demandeCommerciales[] = $demandeCommerciale;
        }

        $manager->flush();
    }
}
