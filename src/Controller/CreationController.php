<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\ChoixCreationEntity;
use App\Entity\Atelier;
use App\Entity\Theme;
use App\Entity\Vacation;

use App\Form\ChoixCreationType;
use App\Form\AtelierType;
use App\Form\ThemeType;
use App\Form\VacationType;

/**
 * @Route("/creer", name="creer")
 */
class CreationController extends AbstractController
{
    /**
     * @Route("/choix", name="_choix")
     */
    public function choixCreation(Request $request, \Doctrine\ORM\EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(ChoixCreationType::class, $choixCreation);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            if($choixCreation == 'atelier')
            {
                return $this->redirectToRoute('creer_atelier');
            }
            elseif($choixCreation == 'theme')
            {
                return $this->redirectToRoute('creer_theme');
            }
            else
            {
                return $this->redirectToRoute('creer_vacation');
            }
        }
        return $this->render('vues/creation/choixCreation.html.twig', [
            'choixCreationForm' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/atelier", name="_atelier")
     */
    public function creationAtelier(Request $request, \Doctrine\ORM\EntityManagerInterface $manager): Response
    {
        $atelier = new Atelier;
        $form = $this->createForm(AtelierType::class, $atelier);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($atelier);
            $manager->flush();
            return $this->redirectToRoute('creer_confirmation');
        }
        return $this->render('vues/creation/creerAtelier.html.twig', [
            'atelierForm' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/theme", name="_theme")
     */
    public function creationTheme(Request $request, \Doctrine\ORM\EntityManagerInterface $manager): Response
    {
        $theme = new Theme;
        $form = $this->createForm(ThemeType::class, $theme);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($theme);
            $manager->flush();
            return $this->redirectToRoute('creer_confirmation');
        }
        return $this->render('vues/creation/creerTheme.html.twig', [
            'creerThemeForm' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/vacation", name="_vacation")
     */
    public function creationVacation(Request $request, \Doctrine\ORM\EntityManagerInterface $manager): Response
    {
        $vacation = new Vacation;
        $form = $this->createForm(VacationType::class, $vacation);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($vacation);
            $manager->flush();
            return $this->redirectToRoute('creer_confirmation');
        }
        return $this->render('vues/creation/creerVacation.html.twig', [
            'creerVacationForm' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/confirmation", name="_confirmation")
     */
    public function creationVacation(Request $request, \Doctrine\ORM\EntityManagerInterface $manager): Response
    {
        return $this->render('vues/creation/confirmation.html.twig', [
            'confirmation' => $form->createView(),
    }
}
