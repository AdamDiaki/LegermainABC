<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * artisan login function
     *
     * @Route("/login",name = "security_login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render( 'security/sign.html.twig', ['lastUsername' => $lastUsername, 'error' => $error] );
    }

    /**
     * artisan logout function
     * @Route("/logout",name = "security_logout")
     */
    public function logout()
    {
    }
}
