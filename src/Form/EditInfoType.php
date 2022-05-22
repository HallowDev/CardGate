<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class EditInfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name',TextType::class,[
            'label' => 'Your complete name',
            'required' => false
        ])
        ->add('adress',TextType::class,[
            'label' => 'Your adress',
            'required' => false
        ])
        ->add('email',EmailType::class,[
            'label' => 'Your email adress',
            'required' => false
        ])    
        ->add('phone',TextType::class,[
            'label' => 'Your phone',
            'required' => false
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
