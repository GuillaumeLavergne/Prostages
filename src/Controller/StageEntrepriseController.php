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
     * @Route("/stage/entreprise/{id}", name="stage_entreprise")
     */
    public function index($id): Response
    {
        //Creer les repository
        $repositoryEntreprise=$this->getDoctrine()->getRepository(Entreprise::class);

        //on recupere l'entreprise en question
        $entreprise=$repositoryEntreprise->find($id);

        //on return la liste de stage
        return $this->render('stage_entreprise/index.html.twig',['entreprise'=>$entreprise]);
    }
}
