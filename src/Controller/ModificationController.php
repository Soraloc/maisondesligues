<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\AtelierRepository;

/**
 * @Route("/modifier", name="modifier")
 */
class ModificationController extends AbstractController
{
    /**
     * Route("/selectionatelier", name="_selectionatelier")
     */
    public function selectionAtelier(AtelierRepository $repo): Response
    {
        $ateliers = $repo->findAll();
        $lesAteliers = array();
        foreach($ateliers as $atelier)
        {
            if($atelier->getLesVacations())
            {
                $lesAteliers[] = $atelier;
            }
        }
        return $this->render('vues/modification/selectionAtelier.html.twig', [
            'ateliers' => $lesAteliers,
        ]);
    }
}
