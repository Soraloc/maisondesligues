<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use App\Entity\Atelier;
use App\Entity\Theme;
use App\Entity\Vacation;

use App\Form\AtelierType;
use App\Form\ThemeType;
use App\Form\VacationType;

use App\Repository\ThemeRepository;
use App\Repository\AtelierRepository;

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
        $form = $this->createFormBuilder()
            ->add('choix', ChoiceType::class, [
                'choices' => [
                    'Atelier' => 'atelier',
                    'Thème' => 'theme',
                    'Vacation' => 'vacation',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->getForm();
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $choixCreation = $form->getData();
            if($choixCreation['choix'] == 'atelier')
            {
                return $this->redirectToRoute('creer_atelier');
            }
            elseif($choixCreation['choix'] == 'theme')
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
    public function creationAtelier(Request $request, \Doctrine\ORM\EntityManagerInterface $manager, ThemeRepository $repo): Response
    {
        $themes = $repo->findAll();
        $atelier = new Atelier;
        $form = $this->createForm(AtelierType::class, $atelier);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($atelier);
            $manager->flush();
            $this->addFlash('confirmation', "L'atelier a bien été créé !");
            return $this->redirectToRoute('creer_choix');
        }
        return $this->render('vues/creation/creerAtelier.html.twig', [
            'themes' => $themes,
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
            $this->addFlash('confirmation', 'Le thème a bien été créé !');
            return $this->redirectToRoute('creer_choix');
        }
        return $this->render('vues/creation/creerTheme.html.twig', [
            'themeForm' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/vacation", name="_vacation")
     */
    public function creationVacation(Request $request, \Doctrine\ORM\EntityManagerInterface $manager, AtelierRepository $repo): Response
    {
        $ateliers = $repo->findAll();
        $vacation = new Vacation;
        $form = $this->createForm(VacationType::class, $vacation);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($vacation);
            $manager->flush();
            $this->addFlash('confirmation', 'La vacation a bien été créée !');
            return $this->redirectToRoute('creer_choix');
        }
        return $this->render('vues/creation/creerVacation.html.twig', [
            'ateliers' => $ateliers,
            'vacationForm' => $form->createView(),
        ]);
    }
    
}
