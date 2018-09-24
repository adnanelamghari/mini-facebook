<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Status;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\StatusType;
use Symfony\Component\HttpFoundation\Request;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function profile(Request $request)
    {
        $status = new Status();
        $form = $this->createForm(StatusType::class, $status);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $status->setDate(new \DateTime());
            // TODO add the current user as owner
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($status);
            $entityManager->flush();
            return $this->redirectToRoute('/profile');
        }

        $user = new User();
        return $this->render('profile/profile.html.twig', [
            'controller_name' => 'Profile',
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
