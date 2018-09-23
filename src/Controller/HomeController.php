<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function home()
    {
        $status = null;
        return $this->render('home/home.html.twig', [
            'status' => $status,
            'controller_name' => 'Home',
        ]);
    }
}
