<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\ORM\EntityManagerInterface;

use App\Form\EntrepriseType;
use App\Form\StageType;
use App\Entity\Formation;
use App\Entity\Entreprise;
use App\Entity\Stage;

class FormulaireStageController extends AbstractController
{
    /**
     * @Route("/profile/ajoutStage", name="ajoutStage")
     */

    public function index(Request $request, EntityManagerInterface $manager): Response
    {

        $stage= New Stage();

        $formulaireStage= $this->createForm(StageType::class,$stage);


        $formulaireStage->handleRequest($request);

        if( $formulaireStage->isSubmitted() && $formulaireStage->isValid())
        {
            $manager->persist($stage);
            $manager->persist($stage->getEntreprise());
            $manager->flush();

            return $this -> redirectToRoute('ajoutStage');
        }
        $vueformulaireStage=$formulaireStage->createView();


        return $this->render('ajoutStage/index.html.twig',['vueFormulaire'=> $vueformulaireStage,'action'=>"ajouter"]);
    }
}