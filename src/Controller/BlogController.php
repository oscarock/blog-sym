<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index()
    {
        $blogs = $this->getDoctrine()
            ->getRepository('App\Entity\Blog')
            ->findAll();

        return $this->render(
            'blog/index.html.twig',
            array('blogs' => $blogs)
        );
    }
}
