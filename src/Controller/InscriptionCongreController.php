<?php

namespace App\Controller;

use Symfony\Component\Security\Core\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\LicencieRepository;
use App\Repository\AtelierRepository;
/**
 * Description of ListeAteliersController
 *
 * @author paul-henri.solat
 */
class InscriptionCongreController extends AbstractController
{
     private $security;

    public function __construct(Security $security)
    {
       $this->security = $security;
    }
    
    /**
     * @Route("/inscriptionCongre", name="inscriptionCongre")
     */
    public function inscriptionCongre(Security $security, LicencieRepository $repoLicencie, AtelierRepository $repoAtelier): Response
    {
       $numlicence = $this->security->getUser()->getUsername();
       $licencie = $repoLicencie->findOneByNumLicence($numlicence);
       $ateliers = $repoAtelier->findAll();
       
       return $this->render('vues/inscriptionCongre.html.twig', [
           'ateliers' => $ateliers,
           'numlicence' => $numlicence,
           'licencie' => $licencie
           ]);
    }
}