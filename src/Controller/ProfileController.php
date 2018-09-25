<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Status;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\StatusType;
use Symfony\Component\HttpFoundation\Request;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile/{idUser}", name="profile")
     */
    public function profile($idUser = 0, Request $request, ObjectManager $entityManager)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        if ($idUser == 0) {
            $idUser = $this->getUser()->getId();
        }
        $user = $repository->find($idUser);
        $status = new Status();
        $form = $this->createForm(StatusType::class, $status);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $status->setDate(new \DateTime())
                ->setUser($user);
            $entityManager->persist($status);
            $entityManager->flush();
            return $this->redirectToRoute('profile');
        }
        return $this->render('profile/profile.html.twig', [
            'controller_name' => 'Profile',
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/profile/delete-status/{idStatus}", name="delete-user")
     */
    public function deleteStatus($idStatus, ObjectManager $entityManager)
    {
        if ($idStatus) {
            $statusRepository = $this->getDoctrine()->getRepository(Status::class);
            $status = $statusRepository->find($idStatus);
            $entityManager->remove($status);
            $entityManager->flush();
        }
        return $this->redirectToRoute('profile');
    }
}
