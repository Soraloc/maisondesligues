<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Form\VacationType;

use App\Repository\AtelierRepository;
use App\Repository\VacationRepository;

/**
 * @Route("/modifier", name="modifier")
 */
class ModificationController extends AbstractController
{
    /**
     * @Route("/selectionatelier", name="_selectionatelier")
     */
    public function selectionAtelier(VacationRepository $repo): Response
    {
        $vacations = $repo->findAll();
        $lesAteliers = array();
        foreach($vacations as $vacation)
        {
            if(!in_array($vacation->getAtelier(), $lesAteliers)) {
                $lesAteliers[] = $vacation->getAtelier();
            }
        }
        return $this->render('vues/modification/selectionAtelier.html.twig', [
            'ateliers' => $lesAteliers,
        ]);
    }
    
    /**
     * @Route("/selectionvacation", name="_selectionvacation")
     */
    public function selectionVacation(Request $request, AtelierRepository $repo): Response
    {
        $idAtelier = $request->query->get('id');
        $atelier = $repo->find($idAtelier);
        $lesVacations = $atelier->getLesVacations();
        return $this->render('vues/modification/selectionVacation.html.twig', [
            'atelier' => $atelier,
            'vacations' => $lesVacations,
        ]);
    }
    
    /**
     * @Route("/modificationvacation", name="_modificationvacation")
     */
    public function modificationVacation(Request $request, \Doctrine\ORM\EntityManagerInterface $manager, VacationRepository $repo): Response
    {
        $idVacation = $request->query->get('idvacation');
        $vacation = $repo->find($idVacation);
        $ancienneVacation = $vacation;
        $atelier = $vacation->getAtelier();
        $form = $this->createForm(VacationType::class, $vacation);
        try {
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid())
            {
                $manager->persist($vacation);
                $manager->flush();
                $this->addFlash('confirmation', 'La vacation a bien été modifiée !');
                return $this->redirectToRoute('modifier_selectionatelier');
            }
        } catch (Exception $ex) {
            $this->addFlash('erreur', $ex->getMessage());
        }
        return $this->render('vues/modification/modificationVacation.html.twig', [
            'idatelier' => $atelier->getId(),
            'vacationForm' => $form->createView(),
        ]);
    }
}
