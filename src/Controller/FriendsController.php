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
    public function friends()
    {
        $user = new User();
        return $this->render('friends/friends.html.twig', [
            'user' => $user,
            'controller_name' => 'Friends',
        ]);
    }

    /**
     * @Route("/friends/add-friend/{idUser}", name="add-friend")
     */
    public function addFriend($idUser)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $friend = $repository->find($idUser);
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $user->addFriend($friend);
        // TODO check if the user we got from app is full
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->refresh($user);
        $entityManager->flush();
        return $this->redirectToRoute('/friends');
    }

    /**
     * @Route("/friends/remove-friend/{idUser}", name="add-friend")
     */
    public function removeFriend($idUser)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $friend = $repository->find($idUser);
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $user->removeFriend($friend);
        // TODO check if the user we got from app is full
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->refresh($user);
        $entityManager->flush();
        return $this->redirectToRoute('/friends');
    }
}
