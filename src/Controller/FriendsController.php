<?php

namespace App\Controller;

use Doctrine\Common\Persistence\ObjectManager;
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
        $repository = $this->getDoctrine()->getRepository(User::class);
        $currentUser = $this->getUser();
        $user = $repository->find($currentUser->getId());
        return $this->render('friends/friends.html.twig', [
            'user' => $user,
            'controller_name' => 'Friends',
        ]);
    }

    /**
     * @Route("/friends/add-friend/{idUser}", name="add-friend")
     */
    public function addFriend($idUser, ObjectManager $entityManager)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $friend = $repository->find($idUser);
        $user = $this->getUser();
        $currentUser = $repository->find($user->getId());
        $currentUser->addFriend($friend);
        // $entityManager->refresh($currentUser);
        $entityManager->flush();
        // return $this->redirect('profile', ['idUser' => $idUser ]);
        return $this->redirect($this->generateUrl('profile', array(
            'idUser' => $idUser
        )));
    }

    /**
     * @Route("/friends/remove-friend/{idUser}", name="remove-friend")
     */
    public function removeFriend($idUser, ObjectManager $entityManager)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $friend = $repository->find($idUser);
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $currentUser = $repository->find($user->getId());
        $currentUser->removeFriend($friend);
        // $entityManager->refresh($currentUser);
        $entityManager->flush();
        // return $this->redirect('profile', ['idUser' => $idUser ]);
        return $this->redirect($this->generateUrl('profile', array(
            'idUser' => $idUser
        )));
    }
}
