<?php

namespace App\Controller;

use App\Entity\Compte;
use App\Entity\Licencie;
use App\Repository\LicencieRepository;
use App\Repository\CompteRepository;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController {

    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $userPasswordEncoder,
            EntityManagerInterface $entityManager, LicencieRepository $repoLicencie, CompteRepository $repoCompte): Response {
        $compte = new Compte();
        $role = array();
        $form = $this->createForm(RegistrationFormType::class, $compte);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $form->get('password')->getData();
            $identifiant = $form->get('identifiant')->getData();
            if (filter_var($identifiant, FILTER_VALIDATE_EMAIL)) {
                $role = array("ROLE_VISITEUR");
//                if ($this->compteExiste($identifiant, $repoCompte)) {
//                    return $this->redirectToRoute('app_login');
//                }
            } elseif (filter_var($identifiant, FILTER_VALIDATE_INT)) {
                $role = array("ROLE_LICENCIE");
                if (!$this->numLicenceExiste($identifiant, $repoLicencie)) {
                    $this->addFlash('erreur', "Le numéro de licence fourni n'existe pas");
                    return $this->redirectToRoute('accueil');
                }
            } else {
                $this->addFlash('erreur', "L'identifiant n'est pas correct");
                return $this->render('vues/ChoixRegister/register.html.twig', [
                            'registrationForm' => $form->createView(),
                ]);
            }
            $compte->setRoles($role);
            $compte->setPassword(
                    $userPasswordEncoder->encodePassword(
                            $compte,
                            $password
            ));
            $entityManager->persist($compte);
            $entityManager->flush();
            $this->addFlash('message', "Compte inscrit crée !");
            return $this->redirectToRoute('app_login');
        }
        return $this->render('vues/ChoixRegister/register.html.twig', [
                    'registrationForm' => $form->createView(),
        ]);
    }

    public function numLicenceExiste(int $identifiant, LicencieRepository $repo) {
        $licencie = $repo->find($identifiant);
        if ($licencie) {
            return true;
        } else {
            return false;
        }
    }

//    public function compteExiste(string $identifiant, CompteRepository $repo) {
//        $compte = $repo->find($identifiant);
//        if ($compte) {
//            return true;
//        } else {
//            return false;
//        }
//    }
//
}
