<?php

namespace App\Controller;

use App\Entity\Group;
use App\Entity\Message;
use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\GroupType;
use App\Form\MessageType;
use Symfony\Component\HttpFoundation\Request;

class GroupController extends AbstractController
{
    /**
     * @Route("/groups", name="groups")
     */
    public function group(Request $request, ObjectManager $entityManager)
    {
        $userRepository = $this->getDoctrine()->getRepository(User::class);
        $user = $userRepository->find($this->getUser()->getId());
        $groupRepository = $this->getDoctrine()->getRepository(Group::class);
        $group = new Group();
        $form = $this->createForm(GroupType::class, $group);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $group->addUser($user);
            $entityManager->persist($group);
            $entityManager->flush();
        }
        $groups = $groupRepository->findAll();
        return $this->render('group/index.html.twig', [
            'controller_name' => 'Groups List',
            'groups' => $groups,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/groups/{IdGroup}", name="group-page")
     */
    public function groupPage($IdGroup, Request $request, ObjectManager $entityManager)
    {
        $userRepository = $this->getDoctrine()->getRepository(User::class);
        $user = $userRepository->find($this->getUser()->getId());
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);
        $groupRepository = $this->getDoctrine()->getRepository(Group::class);
        $group = $groupRepository->find($IdGroup);
        if ($form->isSubmitted() && $form->isValid()) {
            $message->setDate(new \DateTime())
                ->setUser($user)
                ->setMessageGroup($group);
            $entityManager->persist($message);
            $entityManager->flush();
        }
        //$group->addMessage($message);
        $entityManager->flush();
        return $this->render('group/group.html.twig', [
            'controller_name' => $group->getName(),
            'group' => $group,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/groups/{idGroup}/add-user/{idUser}", name="add-user-group")
     */
    public function addUserToGroup($idGroup, $idUser, ObjectManager $entityManager)
    {
        $userRepository = $this->getDoctrine()->getRepository(User::class);
        $user = $userRepository->find($idUser);
        $groupRepository = $this->getDoctrine()->getRepository(Group::class);
        $group = $groupRepository->find($idGroup);
        $group->addUser($user);
        $entityManager->flush();
        return $this->redirect($this->generateUrl('group-page', array(
            'IdGroup' => $idGroup,
        )));
    }
}
