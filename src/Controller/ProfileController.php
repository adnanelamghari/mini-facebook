<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function index()
    {
        $user = new User();
        return $this->render('profile/profile.html.twig', [
            'user' => $user,
            'controller_name' => 'Profile',
        ]);
    }
}
