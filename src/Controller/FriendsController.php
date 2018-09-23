<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FriendsController extends AbstractController
{
    /**
     * @Route("/friends", name="friends")
     */
    public function index()
    {
        $user = new User();
        return $this->render('friends/friends.html.twig', [
            'user' => $user,
            'controller_name' => 'Friends',
        ]);
    }
}
