<?php

namespace App\Form;

use App\Entity\ContactRequests;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Validator\Constraints\Regex;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user_firstName', TextType::class, [
                'label'=>'Prénom',
                'required' => false,
                'attr' => array(
                    'class' => 'form-input',
                    'maxlength' => 20, 
                )
            ])
            ->add('user_lastName', TextType::class, [
                'label'=>'Nom',
                'required' => false,
                'attr' => array(
                    'class' => 'form-input',
                    'maxlength' => 20,
                )
            ])
            ->add('user_eMail', EmailType::class, [
                'attr' => array(
                    'class' => 'form-input'
                ),
                'label' => 'Email',
                'required' => true,
                'constraints' => [
                    new Email([
                        'message' => "L'Email n'est pas correct",
                    ]),
                    new Length([
                        'max' => 255,
                        'maxMessage' => "L'Email ne doit pas dépasser 255 caractères",
                    ]),
                ],
            ])
            ->add('user_phoneNumber', TextType::class, [
                'label'=>'Numéro de téléphone',
                'required' => false,
                'attr' => array(
                    'class' => 'form-input',
                    'maxlength' => 15, 
                ),
                'constraints' => [
                    new Regex([
                        'pattern' => '/^\d+([- ]?\d+)*$/',
                        'message' => "Le numéro de téléphone n'est pas correct",
                    ]),
                ],
            ])
            ->add('user_message', TextareaType::class, [
                'label'=>'Message',
                'required' => false,
                'attr' => array(
                    'class' => 'form-input-text',
                    'maxlength' => 255, 
                )
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactRequests::class,
        ]);
    }
}

