<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntreprisesController extends AbstractController
{
    /**
     * @Route("/entreprises", name="entreprises")
     */

    public function index(): Response
    {
        //$repositoryEntreprise=$this->getDoctrine()->getRepository(Entreprise::class);
        //$entreprises=$repositoryEntreprise->fing($id);

        return $this->render('entreprises/index.html.twig', [
            'controller_name' => 'EntreprisesController',
        ]);
        //,['entreprises -> $entreprises']
    }
}
