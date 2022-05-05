<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AtelierRepository;

/**
 * Description of ListeAteliersController
 *
 * @author paul-henri.solat
 */
class ListeAteliersController extends AbstractController
{
    /**
     * @Route("/listeAteliers", name="listeAteliers")
     */
    public function listeAteliers(AtelierRepository $repoAtelier): Response
    {
        $ateliers = $repoAtelier->findAll();
        return $this->render('vues/listeAteliers.html.twig',['ateliers' => $ateliers]);
    }
}
