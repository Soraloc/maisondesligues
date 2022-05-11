<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModificationHotelController extends AbstractController
{
    /**
     * @Route("/modifHotel", name="modifHotel")
     * @Route("/")
     */
    public function modificationHotel(): Response
    {
        return $this->render('modification/modificationHotel.html.twig');
    }
    
}