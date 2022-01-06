<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Formation;

class FormationsController extends AbstractController
{
    /**
     * @Route("/formations", name="formations")
     */
    public function index(): Response
    {
        $repositoryFormations=$this->getDoctrine()->getRepository(Formation::class);
        $formations=$repositoryFormations->findAll();
        return $this->render('formations/index.html.twig', ['formations' => $formations]);
    }
}
