<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->remove('Title')
            ->remove('MetaTitle')
            ->remove('Slug')
            ->remove('Summary')
            ->remove('Type')
            ->remove('SKU')
            ->remove('Price')
            ->remove('Discount')
            ->remove('Quantity')
            ->remove('Shop')
            ->remove('CreatedAt')
            ->remove('UpdatedAt')
            ->remove('PublishedAt')
            ->remove('StartsAt')
            ->remove('EndAt')
            ->remove('Content')
            ->remove('UserId')
            ->remove('Category')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
