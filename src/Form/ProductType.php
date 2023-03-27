<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Vich\UploaderBundle\Form\Type\VichFileType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Category', EntityType::class, [
                'class' => 'App\Entity\Category',
                'choice_label' => 'Name',
                'multiple' => false,
                'expanded' => false,
                'required' => true,
            ])
            ->add('Title')
            ->add('Summary')
            ->add('SKU')
            ->add('Price')
            ->add('Discount')
            ->add('Quantity')
            ->add('StartsAt')
            ->add('EndAt')
            ->add('Content')

            ->add('Pictures', CollectionType::class, [ 
                'entry_type' => PicturesType::class,
                'entry_options' => [
                    'label' => false,
                    'required' => false,
                ],
                'allow_add' => true,
                'prototype' => true,
                'prototype_name' => '__image_index__',
                'by_reference' => false, 
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
