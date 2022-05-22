<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class EditAccountPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('oldPassword',PasswordType::class,[
                'required' => false,
                'label' => 'Previous password',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please write your password',
                    ]),
                    new UserPassword([
                        'message' => 'Your actual password is not correct.',
                    ]),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The passwords do not match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => false,
                'mapped' => false,
                'first_options'  => [
                    'label' => 'New password',
                    'constraints' => [
                        new NotBlank([
                            'message' => 'You must write a password',
                        ]),
                    ],
                ],
                'second_options' => [
                    'label' => 'Confirm password',
                    'constraints' => [
                        new NotBlank([
                            'message' => 'You must write a password confirmation',
                        ]),
                    ],
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
        ]);
    }
}
