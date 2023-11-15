<?php

namespace App\Form;

use App\Entity\ContactInfo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactInfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('phone_number', TextType::class, [
                'label'=>'Numéro',
                'required' => false,
                'attr' => array(
                    'class' => 'form-input bg-1',
                    'maxlength' => 20, 
                )
            ])
            ->add('e_mail', TextType::class, [
                'label'=>'Email',
                'required' => false,
                'attr' => array(
                    'class' => 'form-input bg-1',
                    'maxlength' => 255, 
                )
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactInfo::class,
        ]);
    }
}
