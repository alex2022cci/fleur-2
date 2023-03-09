<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
           /* ->add('Category', EntityType::class, [
                'class' => 'App\Entity\Category',
                'choice_label' => 'Name',
                'multiple' => false,
                'expanded' => false,
                'required' => true,
            ])*/
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
            ->add('Pictures', CollectionType::class, [ 
                'entry_type' => PicturesType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false,
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
