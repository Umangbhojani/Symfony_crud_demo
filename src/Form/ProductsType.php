<?php

namespace App\Form;

use App\Entity\Products;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;



class ProductsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pname', TextType::class,[
                'label' => 'Enter Product Name',
                'attr' => [
                    'placeholder' => 'Product Name'
                ]
            ])
            ->add('price', IntegerType::class,[
                'label' => 'Enter Price',
                'attr' => [
                    'placeholder' => 'Product Price'
                ]
            ])
            ->add('quntity', IntegerType::class,[
                'label' => 'Enter Quntity',
                'attr' => [
                    'placeholder' => 'Quntity'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }
}
