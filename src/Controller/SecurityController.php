<?php

namespace App\Controller;

use App\Entity\Log;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Doctrine\ORM\EntityManagerInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('vues/ChoixRegister/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
    
    /**
     * @Route("/log", name="app_log")
     */
    public function log(AuthenticationUtils $authenticationUtils, EntityManagerInterface $entityManager): Response
    {
        $log = new Log();
         // récupere le message d'erreur si il y en a un
        $codeErreur = $authenticationUtils->getLastAuthenticationError();
        // récupere l'identifiant rentré
        $lastUsername = $authenticationUtils->getLastUsername();
        if($codeErreur){
            $connexionRouE = false;
        } else {
            $connexionRouE = true;
        }
        $dateConnexion = date("Y-m-d H:i:s");
        $adresseIP = $_SERVER['REMOTE_ADDR'];
        
        $log->setLogin($lastUsername);
        $log->setNumLicence($lastUsername);
        $log->setDateConnexion($dateConnexion);
        $log->setAdresseIP($adresseIP);
        $log->setConnexionRouE($connexionRouE);
        $log->setCodeErreur($codeErreur);
        $entityManager->persist($log);
        $entityManager->flush();
        
        $this->addFlash('message', "Log créé");
        return $this->render('vues/ChoixRegister/login.html.twig', ['last_username' => $lastUsername, 'error' => $codeErreur]);
    }
    
    
}
