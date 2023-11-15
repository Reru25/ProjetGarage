<?php

namespace App\Form;

use App\Entity\WorkingHours;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('monday', TextType::class, [
                'label'=>'Lundi',
                'required' => false,
                'attr' => array(
                    'class' => 'form-input bg-1',
                    'maxlength' => 50, 
                )
            ])
            ->add('tuesday', TextType::class, [
                'label'=>'Mardi',
                'required' => false,
                'attr' => array(
                    'class' => 'form-input bg-1',
                    'maxlength' => 50, 
                )
            ])
            ->add('wednesday', TextType::class, [
                'label'=>'Mercredi',
                'required' => false,
                'attr' => array(
                    'class' => 'form-input bg-1',
                    'maxlength' => 50, 
                )
            ])
            ->add('thursday', TextType::class, [
                'label'=>'Jeudi',
                'required' => false,
                'attr' => array(
                    'class' => 'form-input bg-1',
                    'maxlength' => 50, 
                )
            ])
            ->add('friday', TextType::class, [
                'label'=>'Vendredi',
                'required' => false,
                'attr' => array(
                    'class' => 'form-input bg-1',
                    'maxlength' => 50, 
                )
            ])
            ->add('saturday', TextType::class, [
                'label'=>'Samedi',
                'required' => false,
                'attr' => array(
                    'class' => 'form-input bg-1',
                    'maxlength' => 50, 
                )
            ])
            ->add('sunday', TextType::class, [
                'label'=>'Dimanche',
                'required' => false,
                'attr' => array(
                    'class' => 'form-input bg-1',
                    'maxlength' => 50, 
                )
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => WorkingHours::class,
        ]);
    }
}
