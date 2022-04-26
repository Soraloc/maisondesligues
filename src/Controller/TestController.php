<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of ListeAteliersController
 *
 * @author paul-henri.solat
 */
class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function test(): Response
    {
       return $this->render('vues/test.html.twig');
    }
}
