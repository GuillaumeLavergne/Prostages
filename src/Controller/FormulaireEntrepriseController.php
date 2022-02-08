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

use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Formation;
use App\Entity\Entreprise;

class FormulaireEntrepriseController extends AbstractController
{
    /**
     * @Route("/ajoutEntreprise", name="ajoutEntreprise")
     */

    public function index(Request $request, ObjectManager $manager): Response
    {
        $entreprise = new Entreprise();

        $formulaireEntreprise= $this->createFormBuilder($entreprise)
        ->add('nom')
        ->add('adresse')
        ->add('url')
        ->add('activite')
        ->getForm();

        $formulaireEntreprise->handleRequest($request);

        if( $formulaireEntreprise->isSubmittied())
        {
            $manager->persist($entreprise);
            $manager->flush();

            return $this -> redirectToRoute('ajoutEntreprise');
        }
        $vueFormulaireEntreprise=$formulaireEntreprise->createView();


        return $this->render('ajoutEntreprise/index.html.twig',['vueFormulaire'=> $vueFormulaireEntreprise]);
    }
}