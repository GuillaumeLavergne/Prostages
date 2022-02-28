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

use App\Form\EntrepriseType;
use App\Entity\Formation;
use App\Entity\Entreprise;

class FormulaireEntrepriseController extends AbstractController
{
    /**
     * @Route("/admin/ajoutEntreprise", name="ajoutEntreprise")
     */

    public function index(Request $request, EntityManagerInterface $manager): Response
    {

        $entreprise= New Entreprise();

        $formulaireEntreprise= $this->createForm(EntrepriseType::class,$entreprise);


        $formulaireEntreprise->handleRequest($request);

        if( $formulaireEntreprise->isSubmitted() && $formulaireEntreprise->isValid())
        {
            $manager->persist($entreprise);
            $manager->flush();

            return $this -> redirectToRoute('ajoutEntreprise');
        }
        $vueFormulaireEntreprise=$formulaireEntreprise->createView();


        return $this->render('ajoutEntreprise/index.html.twig',['vueFormulaire'=> $vueFormulaireEntreprise,'action'=>"ajouter"]);
    }
}