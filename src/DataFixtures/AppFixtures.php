<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Formation;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //creation de générateur de données Faker
        $faker= \Faker\Factory::create('fr_FR');
        $Dico=array()
        $DUT = new Formation();
        $DUT->setNomCourt("DUT");
        $DUT->setNomLong("Diplome Univeristaire de Technologie");

        $A=$faker->randomElement();
        $B=$faker->realText(10);
        $C=$faker->realText(10);

        $ABC= new Formation();
        $ABC->setNomCourt($A[0].$B[0].$C[0]);
        $ABC->setNomLong($A." ".$B." ".$C);

        $manager->persist($DUT);
        $manager->persist($ABC);

        $manager->flush();
    }
}
