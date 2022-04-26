<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CompteRepository;

/**
 * Description of ListeAteliersController
 *
 * @author paul-henri.solat
 */
class CompteController extends AbstractController
{
    /**
     * @Route("/compte", name="compte")
     */
    public function compte(CompteRepository $repoCompte): Response
    {
       $compte = $repoCompte->findAll();
       return $this->render('vues/compte.html.twig');
    }
}

