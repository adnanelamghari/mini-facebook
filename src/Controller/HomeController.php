<?php

namespace App\Controller;

use phpDocumentor\Reflection\Types\Array_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Status;
use Doctrine\Common\Persistence\ObjectManager;
use App\Form\StatusType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Collection;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function home(Request $request, ObjectManager $entityManager)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $idUser = $this->getUser()->getId();
        $status = new Status();
        $user = $repository->find($idUser);
        $form = $this->createForm(StatusType::class, $status);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $status->setDate(new \DateTime())
                ->setUser($user);
            $entityManager->persist($status);
            $entityManager->flush();
            return $this->redirectToRoute('profile');
        }
        $statusRepository = $this->getDoctrine()->getRepository(Status::class);
        $status = $statusRepository->findAll();
        /*        $output = null;
                foreach ($status as $st) {
                    if ($user->isFriend($st->getUser()) or $st->getUser()->getId() ==$user->getId()) { //
                        $output[] = $st;
                    }
                }*/
        return $this->render('home/home.html.twig', [
            'status' => $status,
            'controller_name' => 'Home',
            'form' => $form->createView(),
        ]);
    }


}
