<?php

namespace App\Controller;

use App\Entity\Compte;
use App\Entity\Licencie;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;

class RegistrationController extends AbstractController {

    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $userPasswordEncoder, EntityManagerInterface $entityManager): Response {
        $user = new Compte();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        $password = $form->get('plainPassword')->getData();
        $confPassword = $form->get('confPassword')->getData();
        $identifiant = $form->get('identifiant')->getData();
        if ($password == $confPassword && $confPassword != null) {
            if (!filter_var($identifiant, FILTER_VALIDATE_EMAIL)) {
                if (filter_var($identifiant, FILTER_VALIDATE_INT)) {
                    if ($this->numLicenceExiste($entityManager, $identifiant) == true) {
                        if ($this->compteExiste($entityManager, $identifiant) != true) {
                            if ($form->isSubmitted() && $form->isValid()) {
                                $user->setRoles((array) "ROLE_INSCRIT");
                                $user->setPassword(
                                        $userPasswordEncoder->encodePassword(
                                                $user,
                                                $password
                                ));
                                $entityManager->persist($user);
                                $entityManager->flush();
                                $this->addFlash('message', "Compte inscrit crée !");
                                return $this->redirectToRoute('app_login');
                            }
                        } else {
                            return $this->redirectToRoute('app_login');
                        }
                    } else {
                        $this->addFlash('erreur', "Le numéro de licence fournis n'existe pas !");
                        return $this->redirectToRoute('accueil');
                    }
                } else {
                    $this->addFlash('erreur', "Identifiant incorrect !");
                }
            } else {
                if ($form->isSubmitted() && $form->isValid()) {
                    $user->setRoles((array) "ROLE_VISITEUR");
                    $user->setPassword(
                            $userPasswordEncoder->encodePassword(
                                    $user,
                                    $password
                    ));
                    $entityManager->persist($user);
                    $entityManager->flush();
                    $this->addFlash('message', "Compte visiteur crée !");
                    return $this->redirectToRoute('app_login');
                }
            }
        } else {
            $this->addFlash('message', "Les mots de passe ne corresponde pas !");
        }
        return $this->render('vues/ChoixRegister/register.html.twig', [
                    'registrationForm' => $form->createView(),
        ]);
    }

    public function numLicenceExiste(EntityManagerInterface $entityManager, int $numLicence) {
        $licencie = $entityManager->getRepository("App\Entity\Licencie")->findAll();
        foreach ($licencie as $unLicencie) {
            if ($unLicencie->getNumLicence() == $numLicence) {
                return true;
            }
        }
        return false;
    }

    public function compteExiste(EntityManagerInterface $entityManager, int $numLicence) {
        $compte = $entityManager->getRepository("App\Entity\Compte")->findAll();
        foreach ($compte as $unCompte) {
            if ($unCompte->getIdentifiant() == $numLicence) {
                return true;
            }
        }
        return false;
    }

}
