<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function accueil(): Response
    {
        define('SENDGRID_API_KEY','
                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' );
    }
}
