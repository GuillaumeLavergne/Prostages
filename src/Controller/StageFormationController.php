<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Stage;
use App\Entity\Formation;

class StageFormationController extends AbstractController
{
    /**
     * @Route("/stage/formation/{nom}", name="stage_formation")
     */

    public function index($nom): Response
    {
        //faire le repository des formations
        $repositoryStage=$this->getDoctrine()->getRepository(Stage::class);

        //recuperer la formations
        $nomFormation=$nom;

        $stages=$repositoryStage->findStagesByFormation($nomFormation);
        //retourner les valeurs
        return $this->render('stage_formation/index.html.twig', ['stages'=>$stages,'nomFormation'=>$nomFormation]);
    }
}
