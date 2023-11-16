<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use App\Entity\Annonce;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class AnnouncmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('brand', TextType::class, [
                'label'=>'Marque',
                'required' => true,
                'attr' => array(
                    'class' => 'form-input bg-1',
                    'maxlength' => 20,
                    ),
                ])
            ->add('model', TextType::class, [
                'label'=>'Modèle',
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
                    'class' => 'form-input bg-1 input-dynamic-h',
                    ),
                ])
            ->add('year', NumberType::class, [
                'label'=>'Année',
                'required' => true,
                'attr' => array(
                    'class' => 'form-input bg-1',
                    'maxlength' => 4,
                    ),
                ])
            ->add('mileage', NumberType::class, [
                'label'=>'Kilométrage',
                'required' => true,
                'attr' => array(
                    'class' => 'form-input bg-1',
                    'maxlength' => 20,
                    ),
                ])
            ->add('fuel_type', TextType::class, [
                'label'=>'Carburant',
                'required' => true,
                'attr' => array(
                    'class' => 'form-input bg-1',
                    'maxlength' => 20,
                    ),
                ])
            ->add('transmission', TextType::class, [
                'label'=>'Boîte de vitesse',
                'required' => true,
                'attr' => array(
                    'class' => 'form-input bg-1',
                    'maxlength' => 20,
                    ),
                ])
            ->add('price', NumberType::class, [
                'label'=>'Prix',
                'required' => true,
                'attr' => array(
                    'class' => 'form-input bg-1',
                    'maxlength' => 20,
                    ),
                ])
            ->add('imgPath1', FileType::class, [
                'label' => 'Image Principale',
                'data_class' => null ,
                'required' => true,
                'attr' => array(
                    'class' => 'form-input',
                    ),
                ])
            ->add('imgPath2', FileType::class, [
                'label' => 'Image',
                'data_class' => null ,
                'required' => false,
                'attr' => array(
                    'class' => 'form-input',
                    ),
                ])
            ->add('imgPath3', FileType::class, [
                'label' => 'Image',
                'data_class' => null ,
                'required' => false,
                'attr' => array(
                    'class' => 'form-input',
                    ),
                ])
            ->add('imgPath4', FileType::class, [
                'label' => 'Image',
                'data_class' => null ,
                'required' => false,
                'attr' => array(
                    'class' => 'form-input',
                    ),
                ])
            ->add('imgPath5', FileType::class, [
                'label' => 'Image',
                'data_class' => null ,
                'required' => false,
                'attr' => array(
                    'class' => 'form-input',
                    ),
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annonce::class,
        ]);
    }
}
