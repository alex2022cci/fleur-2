<?php

namespace App\Form;

use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'attr' => [
                    'placeholder' => 'First Name',
                ],
            ])
            ->add('lastName', TextType::class, [
                'attr' => [
                    'placeholder' => 'Last Name',
                ],
            ])


            ->add('subTotal')
            ->add('itemDiscount')
            ->add('tax')
            ->add('shipping')
            ->add('total')
            ->add('promo')
            ->add('discount')
            ->add('grandTotal')

            ->add('middleName')

            ->add('mobile')
            ->add('email')
            ->add('line1')
            ->add('line2')
            ->add('city')
            ->add('province')
            ->add('country')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('content')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
