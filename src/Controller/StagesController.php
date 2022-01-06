<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Stage;
use App\Entity\Entreprise;
use App\Entity\Formation;

class StagesController extends AbstractController
{
    /**
     * @Route("/stages/{id}", name="stages")
     */
    public function index($id): Response
    {
        //On fait les repository
        $repositoryStage=$this->getDoctrine()->getRepository(Stage::class);
        $repositoryEntreprise=$this->getDoctrine()->getRepository(Entreprise::class);
        $repositoryFormation=$this->getDoctrine()->getRepository(Formation::class);

        //on recupere le stage en question
        $stage=$repositoryStage->findBy(["id"=>$id]);

        //on recupere l'entreprise qui as propose pour ce stage
        $
        return $this->render('stages/index.html.twig', ['stages'=>$stage]);
    }
}
