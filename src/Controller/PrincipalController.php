<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Stage;

class PrincipalController extends AbstractController
{
    /**
     * @Route("/principal", name="principal")
     */
    public function index(): Response
    {
        $repositoryStage=$this->getDoctrine()->getRepository(Stage::class);
        $stages=$repositoryStage->findAll();
        return $this->render('principal/index.html.twig',['stages' => $stages]);

    }
}
