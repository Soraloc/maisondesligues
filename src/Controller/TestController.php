<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use ;

class TestController extends AbstractController {

    /**
     * @Route("/test", name="test")
     */
    public function accueil(): Response {
        define('SENDGRID_API_KEY', '
                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');
    }

    /**
     * @Route("/mail", name="mail")
     */
    public function Mail(): Response {
         $email = (new Email())
            ->from('hello@example.com')
            ->to('you@example.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $mailer->send($email);
    }

}
