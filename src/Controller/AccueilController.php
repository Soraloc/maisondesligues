<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil")
     * @Route("/")
     */
    public function accueil(HotelRepository $repo): Response
    {
        $hotels = $repo->findAll();
        return $this->render('vues/accueil.html.twig', ['hotels'=> $hotels,]);
    }
}