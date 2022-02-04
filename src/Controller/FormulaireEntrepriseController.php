<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Formation;
use App\Entity\Entreprise;

class FormulaireEntrepriseController extends AbstractController
{
    /**
     * @Route("/ajoutEntreprise", name="ajoutEntreprise")
     */

    public function index(): Response
    {
        $entreprise = new Entreprise();

        $formulaireEntreprise= $this->createFormBuilder($entreprise)
        ->add('nom')
        ->add('adresse')
        ->add('url')
        ->add('activite')
        ->getForm();

        $vueFormulaireEntreprise=$formulaireEntreprise->createView();


        return $this->render('ajoutEntreprise/index.html.twig',['vueFormulaire'=> $vueFormulaireEntreprise]);
    }
}