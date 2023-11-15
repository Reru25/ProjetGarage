<?php

namespace App\Form;

use App\Entity\Services;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label'=>'Titre',
                'required' => true,
                'attr' => array(
                    'class' => 'form-input bg-1',
                    'maxlength' => 20,
                    ),
                ])
            ->add('description', TextareaType::class, [
                'label'=>'Description',
                'required' => false,
                'attr' => array(
                    'class' => 'form-input bg-1 h-100 resize-none',
                    'maxlength' => 80,
                    ),
                ])
            ->add('price', TextType::class, [
                'label'=>'Prix (Laisser vide si bouton de contact)',
                'required' => false,
                'attr' => array(
                    'class' => 'form-input bg-1',
                    'maxlength' => 20,
                    ),
                ])
            ->add('imgPath', FileType::class, [
                'label'=> 'Image',
                'data_class' => null ,
                'required' => true,
                'attr' => array(
                    'class' => 'form-input',
                    'maxlength' => 80,
                    ),
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Services::class,
        ]);
    }
}
