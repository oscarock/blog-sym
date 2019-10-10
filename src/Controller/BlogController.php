<?php

namespace App\Controller;

use App\Entity\Blog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

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

    public function new(Request $request)
    {
        // creates a task object and initializes some data for this example
        $blogs = new Blog();
        //$blogs->setTopic('Write a blog post');
        //$blogs->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($blogs)
        ->add('topic', ChoiceType::class, ['choices' => ['Juegos' => 'juegos', 'Tecnologia' => 'tecnologia', 'Belleza' => 'belleza'], 'label' => 'Categoria', 'required' => 'required', 'attr' => ['class' => 'form-control', 'placeholder' => 'Categoria']])
        ->add('title', TextType::class, ['label' => 'Titulo', 'required' => 'required', 'attr' => ['class' => 'form-control', 'placeholder' => 'Titulo']])
        ->add('body', TextareaType::class, ['label' => 'Contenido', 'required' => 'required', 'attr' => ['class' => 'form-control', 'placeholder' => 'Contenido']])
        ->add('author', TextType::class, ['label' => 'Autor', 'required' => 'required', 'attr' => ['class' => 'form-control', 'placeholder' => 'Autor']])
        ->add('image', TextareaType::class, ['label' => 'Url Imagen', 'required' => 'required', 'attr' => ['class' => 'form-control', 'placeholder' => 'Url Imagen']])
        ->add('save', SubmitType::class, ['label' => 'Guardar', 'attr' => ['class' => 'btn btn-success form-control mt-3']])
        ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $blogs = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($blogs);
            $em->flush();

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
                'No se encontro el id'. $id
            );
        }

        return $this->render(
            'blog/show.html.twig',
            array('blog' => $blog)
        );
    }
}
