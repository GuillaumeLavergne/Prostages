<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Formation;
use App\Entity\Entreprise;
use App\Entity\Stage;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //creation de générateur de données Faker
        $faker= \Faker\Factory::create('fr_FR');
        
        //
        //DECLARATION DES DIFFERENTES FORMATIONS
        //
        $DUT = new Formation();
        $DUT->setNomCourt("DUT");
        $DUT->setNomLong("Diplome Univeristaire de Technologie");

        for($i=0;$i<15;$i++)
        {   
            $A=$faker->word();
            $B=$faker->word();
            $C=$faker->word();

            $ABC= new Formation();
            $ABC->setNomCourt(strtoupper($A[0]).strtoupper($B[0]).strtoupper($C[0]));
            $ABC->setNomLong($A." ".$B." ".$C);
            $manager->persist($ABC);

        }
        $manager->persist($DUT);

        //
        //DECLARATIONS DES ENTREPRISES
        //
        $activites=array(   "Informatique orienté objet",
                            "Programmation web",
                            "Vendeur de tapis éléctroniques",
                            "Vendeur de chouchoux automatisés sur plage et balcons",
                            "Vendeur de tronconneuse roses",
                            "Vendeurs d'enfants magnétiques IA");

        for($i=1;$i<15;$i++)
        {
            $entreprise=new Entreprise();

            $entreprise->setNom($faker->company().$faker->companySuffix());
            $entreprise->setAdresse($faker->address());
            $entreprise->setActivite($activites[$faker->numberBetween(0,count($activites)-1)]);
            $entreprise->setUrl("https://".$entreprise->getNom().".com");
            $manager->persist($entreprise);
        }

        $manager->flush();
    }
}
