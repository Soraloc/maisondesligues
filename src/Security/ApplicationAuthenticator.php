<?php

namespace App\Security;

use App\Entity\Compte;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Guard\PasswordAuthenticatedInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use App\Controller\SecurityController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ApplicationAuthenticator extends AbstractFormLoginAuthenticator implements PasswordAuthenticatedInterface
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'app_login';

    private $entityManager;
    private $urlGenerator;
    private $csrfTokenManager;
    private $passwordEncoder;

    public function __construct(EntityManagerInterface $entityManager, UrlGeneratorInterface $urlGenerator, CsrfTokenManagerInterface $csrfTokenManager, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->entityManager = $entityManager;
        $this->urlGenerator = $urlGenerator;
        $this->csrfTokenManager = $csrfTokenManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function supports(Request $request)
    {
        return self::LOGIN_ROUTE === $request->attributes->get('_route')
            && $request->isMethod('POST');
    }

    public function getCredentials(Request $request)
    {
        $credentials = [
            'identifiant' => $request->request->get('identifiant'),
            'password' => $request->request->get('password'),
            'csrf_token' => $request->request->get('_csrf_token'),
        ];
        $request->getSession()->set(
            Security::LAST_USERNAME,
            $credentials['identifiant']
        );

        return $credentials;
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $token = new CsrfToken('authenticate', $credentials['csrf_token']);
        if (!$this->csrfTokenManager->isTokenValid($token)) {
            throw new InvalidCsrfTokenException();
        }

        $user = $this->entityManager->getRepository(Compte::class)->findOneBy(['identifiant' => $credentials['identifiant']]);

        if (!$user) {
            throw new UsernameNotFoundException('Identifiant could not be found.');
        }

        return $user;
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return $this->passwordEncoder->isPasswordValid($user, $credentials['password']);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function getPassword($credentials): ?string
    {
        return $credentials['password'];
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
       $this->log($authenticationUtils, $entityManager);
        if ($targetPath = $this->getTargetPath($request->getSession(), $providerKey)) {
            return new RedirectResponse($targetPath);
        }
        
        // For example : return new RedirectResponse($this->urlGenerator->generate('some_route'));
        return new RedirectResponse($this->urlGenerator->generate('accueil'));
    }

    protected function getLoginUrl()
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
    
    private function log(AuthenticationUtils $authenticationUtils, EntityManagerInterface $entityManager): Response
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
            $codeErreur = "0";
        }
        $dateConnexion = new DateTime();
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
