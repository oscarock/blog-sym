<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function new()
    {
        return $this->render('contact/new.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }
}
