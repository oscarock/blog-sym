<?php

namespace App\Form;

use App\Entity\Blog;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class BlogFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('topic', ChoiceType::class, ['choices' => ['Juegos' => 'juegos', 'Tecnologia' => 'tecnologia', 'Belleza' => 'belleza'], 'label' => 'Categoria', 'required' => 'required', 'attr' => ['class' => 'form-control', 'placeholder' => 'Categoria']])
            ->add('title', TextType::class, ['label' => 'Titulo', 'required' => 'required', 'attr' => ['class' => 'form-control', 'placeholder' => 'Titulo']])
            ->add('body', TextareaType::class, ['label' => 'Contenido', 'required' => 'required', 'attr' => ['class' => 'form-control', 'placeholder' => 'Contenido']])
            ->add('author', TextType::class, ['label' => 'Autor', 'required' => 'required', 'attr' => ['class' => 'form-control', 'placeholder' => 'Autor']])
            ->add('image', TextareaType::class, ['label' => 'Url Imagen', 'required' => 'required', 'attr' => ['class' => 'form-control', 'placeholder' => 'Url Imagen']])
            ->add('save', SubmitType::class, ['label' => 'Guardar', 'attr' => ['class' => 'btn btn-success form-control mt-3']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Blog::class,
        ]);
    }
}
