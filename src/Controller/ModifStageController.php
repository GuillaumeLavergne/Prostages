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

class ModifStageController extends AbstractController
{
    /**
     * @Route("/modifStage/{id}", name="modifStage")
     */

    public function index(Request $request, EntityManagerInterface $manager, Stage $stage): Response
    {
        $formulaireStage= $this->createForm(StageType::class,$stage);


        $formulaireStage->handleRequest($request);

        if( $formulaireStage->isSubmitted())
        {
            $manager->persist($stage);
            $manager->flush();

            return $this -> redirectToRoute('principal');
        }
        $vueFormulaireStage=$formulaireStage->createView();


        return $this->render('ajoutStage/index.html.twig',['vueFormulaire'=> $vueFormulaireStage,'action'=> "modifier"]);
    }
}