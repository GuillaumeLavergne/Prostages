<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Entreprise;
use App\Entity\Stage;

class StageEntrepriseController extends AbstractController
{
    /**
     * @Route("/stage/entreprise/{nom}", name="stage_entreprise")
     */
    public function index($nom): Response
    {
        //Creer les repository
        $repositoryStage=$this->getDoctrine()->getRepository(Stage::class);

        //on recupere l'entreprise en question
        $nomEntreprise=$nom;

        $stages=$repositoryStage->findStagesByEntreprise($nomEntreprise);

        //on return la liste de stage
        return $this->render('stage_entreprise/index.html.twig',['stages'=>$stages,'nomEntreprise'=>$nomEntreprise]);

    }
}
