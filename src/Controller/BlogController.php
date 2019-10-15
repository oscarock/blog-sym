<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Form\BlogFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

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

    /**
     * @Route("/my_blogs", name="my_blogs")
     */
    public function my_blogs()
    {
        $blogs = $this->getDoctrine()
            ->getRepository('App\Entity\Blog')
            ->findBy(['user' => $this->getUser()]);
            
            return $this->render(
            'blog/index.html.twig',
            array('blogs' => $blogs)
        );
    }

    /**
     * @Route("/new", name="new")
    */
    public function new(EntityManagerInterface $em, Request $request)
    {
        $blogs = new Blog();

        $form = $this->createForm(BlogFormType::class, $blogs);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $data = $form->getData();
            
            $blogs->setTopic($form->get('topic')->getData());
            $blogs->setTitle($form->get('title')->getData());
            $blogs->setBody($form->get('body')->getData());
            $blogs->setAuthor($form->get('author')->getData());
            $blogs->setImage($form->get('image')->getData());
            $blogs->setUser($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($blogs);
            $em->flush();

            $this->addFlash('success', 'Formulario Guardado correctamente.');

            return $this->redirect('/blog/');

        }

        return $this->render('blog/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/show", name="show")
    */
    public function show($id)
    {
        $blog = $this->getDoctrine()
            ->getRepository('App\Entity\Blog')
            ->find($id);

        if(!$blog){
            throw $this->createNotFoundException(
                'No se encontro el id'
            );
        }

        return $this->render(
            'blog/show.html.twig',
            array('blog' => $blog)
        );
    }

    /**
     * @Route("/edit", name="edit")
    */
    public function edit(Request $request, $id)
    {
        $do = $this->getDoctrine()->getManager();
        $blog = $do->getRepository('App\Entity\Blog')->find($id);

        if (!$blog) {
            throw $this->createNotFoundException(
                'No se encontro el id'
            );
        }

        $form = $this->createForm(BlogFormType::class, $blog);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $data = $form->getData();

            $blogs->setTopic($form->get('topic')->getData());
            $blogs->setTitle($form->get('title')->getData());
            $blogs->setBody($form->get('body')->getData());
            $blogs->setAuthor($form->get('author')->getData());
            $blogs->setImage($form->get('image')->getData());
            $blogs->setUser($this->getUser());
            $do->flush();

            $this->addFlash('success', 'Formulario Editado correctamente.');

            return $this->redirect('/blog/');
        }

        return $this->render('blog/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function searchTittle(Request $request){
        $em = $this->getDoctrine()
            ->getManager()
            ->getRepository('App\Entity\Blog');

        $search = $request->query->get('search');

        if ($search) {
            $blogs = $em->findBy(['title' => $search]);
        } else {
            $blogs = $em->findAll();
            
        }

        return $this->render(
            'blog/index.html.twig',
            array('blogs' => $blogs)
        );
    }

    public function searchCategory(Request $request, $category){
        $em = $this->getDoctrine()
        ->getManager()
        ->getRepository('App\Entity\Blog');

        if ($category) {
            $blogs = $em->findBy(['topic' => $category]);
        } 

        if($category == "todas"){
            $blogs = $em->findAll();
        }

        return $this->render(
            'blog/index.html.twig',
            array('blogs' => $blogs)
        );
    }

}
