<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Nombre', 'required' => 'required', 'attr' => ['class' => 'form-control', 'placeholder' => 'Nombre']])
            ->add('email', TextType::class, ['label' => 'Email', 'required' => 'required', 'attr' => ['class' => 'form-control', 'placeholder' => 'Email']])
            ->add('message', TextareaType::class, ['label' => 'Mensaje', 'required' => 'required', 'attr' => ['class' => 'form-control', 'placeholder' => 'Mensaje']])
            ->add('save', SubmitType::class, ['label' => 'Guardar', 'attr' => ['class' => 'btn btn-success form-control mt-3']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
