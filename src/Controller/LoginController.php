<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
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
            'controller_name' => 'Login',
            'error' => $error,
        ));
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
        return $this->render('login/login.html.twig', array(
            'controller_name' => 'Login',
        ));
    }

    /**
     * @Route("/before-logout", name="before-logout")
     */
    public function beforeLogout(ObjectManager $entityManager)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $idUser = $this->getUser()->getId();
        $currentUser = $repository->find($idUser);
        if ($currentUser->getIsOnline()) {
            $currentUser->setIsOnline(false);
            $entityManager->flush();
        }
        return $this->redirectToRoute('logout');
    }
}
