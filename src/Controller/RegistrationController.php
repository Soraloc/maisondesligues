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
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class RegistrationController extends AbstractController {

    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $userPasswordEncoder,
            EntityManagerInterface $entityManager, LicencieRepository $repoLicencie, CompteRepository $repoCompte, MailerInterface $mailer): Response {
        $compte = new Compte();
        $role = array();
        $form = $this->createForm(RegistrationFormType::class, $compte);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $form->get('password')->getData();
            $identifiant = $form->get('identifiant')->getData();
            if (filter_var($identifiant, FILTER_VALIDATE_EMAIL)) {
                $role = array("ROLE_USER");
//                if ($this->compteExiste($identifiant, $repoCompte)) {
//                    return $this->redirectToRoute('app_login');
//                }
            } elseif (filter_var($identifiant, FILTER_VALIDATE_INT)) {
                $role = array("ROLE_INSCRIT");
                if (!$this->numLicenceExiste($identifiant, $repoLicencie)) {
                    $this->addFlash('erreur', "Le numéro de licence fourni n'existe pas");
                    return $this->redirectToRoute('accueil');
                }
            } else {
                $this->addFlash('erreur', "L'identifiant n'est pas correct");
                return $this->render('authentification/register.html.twig', [
                            'registrationForm' => $form->createView(),
                ]);
            }
            $this->sendMailValid((string) $identifiant, $mailer, $repoLicencie);
            $compte->setRoles($role);
            $compte->setMailValide(false);
            $compte->setPassword(
                    $userPasswordEncoder->encodePassword(
                            $compte,
                            $password
            ));
            $entityManager->persist($compte);
            $entityManager->flush();
            $this->addFlash('message', "Compte créé !");
            return $this->redirectToRoute('app_login');
        }
        return $this->render('authentification/register.html.twig', [
                    'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/verifmail/{identifiant}", name="verifmail")
     */
    public function verifMail($identifiant, CompteRepository $repo, EntityManagerInterface $entityManager) {
        $compte = $repo->findOneByUsername($identifiant);
        $compte->setMailValide(true);
        $entityManager->persist($compte);
        $entityManager->flush();
        $this->addFlash('message', "Email validé");
        return $this->redirectToRoute('app_login');
    }

    public function numLicenceExiste(int $identifiant, LicencieRepository $repo) {
        $licencie = $repo->findOneByNumLicence($identifiant);
        if ($licencie) {
            return true;
        } else {
            return false;
        }
    }

    public function sendMailValid(string $identifiant, MailerInterface $mailer, LicencieRepository $repo) {
        if (!filter_var($identifiant, FILTER_VALIDATE_EMAIL)) {
            $licencie = $repo->findOneByNumLicence($identifiant);
            $emailAEnvoyer = $licencie->getMail();
            $email = (new Email())
                    ->from('garambois.lucas@gmail.com')
                    ->to('garambois.lucas@gmail.com')
                    ->cc($emailAEnvoyer)
                    //->bcc('bcc@example.com')
                    //->replyTo('fabien@example.com')
                    //->priority(Email::PRIORITY_HIGH)
                    ->subject('Confirmation du mail')
                    ->text('Email send')
                    ->html('<p>Veuillez cliquez sur le lien suivant pour valider votre inscription</p> <br> '
                    . '<a href="http://maison-des-ligues/verifmail/' . $identifiant . '">Verif Mail</a>');

            $mailer->send($email);
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
