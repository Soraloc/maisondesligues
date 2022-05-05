<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\HotelRepository;
use App\Repository\AtelierRepository;

class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil")
     * @Route("/")
     */
    public function accueil(HotelRepository $repoHotel, AtelierRepository $repoAtelier): Response
    {
        $hotels = $repoHotel->findAll();
        $ateliers = $repoAtelier->findAll();
        return $this->render('accueil.html.twig', [
            'hotels' => $hotels,
            'ateliers' => $ateliers
        ]);
    }
}