<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('model',TextType::class,[
                'label' => 'Model',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Write the model here...'
                ]
            ])
            ->add('price',MoneyType::class,[
                'label' => 'Price',
                'required' => false,
                'divisor' => 100
            ])
            ->add('manufacturer',TextType::class,[
                'label' => 'Manufacturer',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Write the manufacturer here...'
                ]
            ])
            ->add('image',TextType::class,[
                'label' => 'Image',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Add the image path here...'
                ]
            ])
            ->add('chipset',TextType::class,[
                'label' => 'Chipset',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Write the chipset here...'
                ]
            ])
            ->add('category',EntityType::class,[
                'label' => 'Choose the category',
                'placeholder' => '-- Choose --',
                'required' => false,
                'class' => Category::class
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
