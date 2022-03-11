<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Formation;
use App\Entity\Entreprise;
use App\Entity\Stage;
use App\Entity\User;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //creation des users
        $guillaume= new User();
        $guillaume->setPrenom("Guillaume");
        $guillaume->setNom("Lavergne");
        $guillaume->setEmail("guillaumelavergne775@gmail.com");
        $guillaume->setRoles(["ROLE_USER" , "ROLE_ADMIN"]);
        $guillaume->setPassword('$2y$10$TjPyc67NLJwMMaL4rY1aVuM6OFk1n71OXXja4BtS4v0GeLPrVGl8K');

        $manager->persist($guillaume);

        //creation de générateur de données Faker
        $faker= \Faker\Factory::create('fr_FR');
        
        //
        //DECLARATION DES DIFFERENTES FORMATIONS
        //

        $formations=array();//liste compléte des formations

        $f1 = array("Enseignement","Diplome","Institut","Brevet","Universite","Doctorat","Master","Prepa");
        $f2 = array("Universitaire","Technologique","Scientifique","Professionel");
        $f3 = array("Programmtion","Developpement web","Conception orientée objets","Design","Stastiques informatiques","Management","Developpement android");

        $DUT = new Formation();//on créer le DUT
        $DUT->setNomCourt("DUT");
        $DUT->setNomLong("Diplome Univeristaire de Technologie");
        array_push($formations,$DUT);

        $manager->persist($DUT);


        for($i=0;$i<15;$i++)//on génére aléatoirement des formations
        {   
            $Mot1=$f1[$faker->numberBetween(0,count($f1)-1)];
            $Mot2=$f2[$faker->numberBetween(0,count($f2)-1)];
            $Mot3=$f3[$faker->numberBetween(0,count($f3)-1)];
            
            $Lettre1=str_split($Mot1);
            $Lettre2=str_split($Mot2);
            $Lettre3=str_split($Mot3);

            $formation= new Formation();
            $formation->setNomCourt($Lettre1[0].$Lettre2[0].$Lettre3[0]);
            $formation->setNomLong($Mot1." ".$Mot2." de ".$Mot3);

            array_push($formations,$formation);

            $manager->persist($formation);

        }
        

        //
        //DECLARATIONS DES ENTREPRISES
        //
        $activites=array(   "Informatique orienté objet",
                            "Programmation web",
                            "Vendeur de tapis éléctroniques",
                            "Vendeur de chouchoux automatisés sur plage et balcons",
                            "Vendeur de tronconneuse roses",
                            "Vendeurs d'enfants magnétiques IA",
                            "Createurs d'animatronic",
                            "Chercheurs quantiques",
                            "Modelisation de metadonnées",
                            "Statisticiens et analystes informatique");

        $entreprises= array();//liste compléte des entreprises

        for($i=1;$i<15;$i++)
        {
            $entreprise=new Entreprise();

            $entreprise->setNom($faker->company().$faker->companySuffix());
            $entreprise->setAdresse($faker->address());
            $entreprise->setActivite($activites[$faker->numberBetween(0,count($activites)-1)]);
            $entreprise->setUrl("https://".$entreprise->getNom().".com");

            array_push($entreprises,$entreprise);

            $manager->persist($entreprise);
        }


        //
        //DECLARATION DES STAGES
        //
        $metier= array("Developpeur","Programmeur","Designer","Statisticien","Analyste","Informaticien","Codeur","Concepteur");
        $language = array("C","C++","C#","JAVA","JAVASCRIPT","BASH","UML","CSS","PHP","HTML","SQL","Python","R","Fortran");
        $logiciel = array("Rstudio","Eclipse","Modelio","Visual Studio Code","Balsamiq","Code:blocks","Symfony","Spider");
        $plateforme = array("Linux","Unix","Windows");
        $periode = array("an(s)","minute(s)","heure(s)","seconde(s)","jour(s)","mois","semaine(s)");

        for($i=1;$i<75;$i++)//boucle de generation de stage
        {
            $stage= new Stage();

            //Generation des variables aleatoires
            $metierStage=$metier[$faker->numberBetween(0,count($metier)-1)];
            $languageStage=$language[$faker->numberBetween(0,count($language)-1)];
            $titreStage=$metierStage." en ".$languageStage;

            $stage->setTitre($titreStage);
            $stage->setMission($titreStage." sur le logiciel ".$logiciel[$faker->numberBetween(0,count($logiciel)-1)]." sous ".$plateforme[$faker->numberBetween(1,count($plateforme)-1)].", pour une durée de ".$faker->numberBetween(0,12)." ".$periode[$faker->numberBetween(0,count($periode)-1)]);
            $stage->setEmail($faker->email());

            $stage->setEntreprise($entreprises[$faker->numberBetween(0,count($entreprises)-1)]);

            $nbFormations=$faker->numberBetween(1,count($formations)-1);
            $formationsDejaSelectionnees = array();

            for($y=0;$y<=$nbFormations;$y++)//boucle d'ajout des formations
            {
                $boolean="FALSE";

                $formationTiree=$faker->numberBetween(0,count($formations)-1);

                for($z=0;$z<count($formationsDejaSelectionnees);$z++)//boucle de verification des formations deja ajoutées
                {
                    if($formationsDejaSelectionnees[$z]==$formationTiree)
                    {
                        $boolean = "TRUE";
                    }
                }

                if($boolean=="FALSE")
                {
                    array_push($formationsDejaSelectionnees,$formationTiree);
                    $stage->addFormation($formations[$formationTiree]);
                }
                else
                {
                    $y--;
                }

            }

            $manager->persist($stage);
        }

        $manager->flush();
    }
}
