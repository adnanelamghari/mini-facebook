<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/login.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
            'controller_name' => 'Login',
        ));
    }

    /**
     * @Route("/logout, name="logout")
     */
    public function logout()
    {

        return $this->render('login/login.html.twig', array(
            'controller_name' => 'Login',
        ));
    }
}
