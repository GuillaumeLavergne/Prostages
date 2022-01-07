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
     * @Route("/stage/formation/{id}", name="stage_formation")
     */

    public function index($id): Response
    {
        //faire le repository des formations
        $repositoryFormation=$this->getDoctrine()->getRepository(Formation::class);

        //recuperer la formations
        $formation=$repositoryFormation->find($id);

        //retourner les valeurs
        return $this->render('stage_formation/index.html.twig', ['formation'=>$formation]);
    }
}
