<?php

namespace App\Form;

use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\Validator\Constraints\Length;
use App\Entity\Reviews;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('grade', NumberType::class, [
                'label'=> 'Note (chiffre entre 0 et 5)',
                'required' => true,
                'attr' => [
                    'class' => 'form-input bg-1',
                    'maxlength' => 1, 
                ],
                'constraints' => [
                    new Range([
                        'max' => 5, 
                        'maxMessage' => 'La note maximale est 5/5',
                    ]),
                ],
            ])
            ->add('review', TextareaType::class, [
                'label'=> 'Commentaire',
                'required' => false,
                'attr' => [
                    'class' => 'form-input bg-1 h-100 resize-none',
                    'maxlength' => 100, 
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reviews::class,
        ]);
    }
}
