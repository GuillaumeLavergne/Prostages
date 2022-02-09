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

use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Formation;
use App\Entity\Entreprise;

class ModifEntrepriseController extends AbstractController
{
    /**
     * @Route("/modifEntreprise/{id}", name="modifEntreprise")
     */

    public function index(Request $request, EntityManagerInterface $manager, Entreprise $entreprise): Response
    {
        $formulaireEntreprise= $this->createFormBuilder($entreprise)
        ->add('nom')
        ->add('adresse')
        ->add('url')
        ->add('activite')
        ->getForm();

        $formulaireEntreprise->handleRequest($request);

        if( $formulaireEntreprise->isSubmitted())
        {
            $manager->persist($entreprise);
            $manager->flush();

            return $this -> redirectToRoute('entreprises');
        }
        $vueFormulaireEntreprise=$formulaireEntreprise->createView();


        return $this->render('ajoutEntreprise/index.html.twig',['vueFormulaire'=> $vueFormulaireEntreprise,'action'=> "modifier"]);
    }
}