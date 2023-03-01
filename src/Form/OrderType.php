<?php

namespace App\Form;

use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
            ->add('mobile', TelType::class, [
                'attr' => [
                    'placeholder' => 'Mobile',
                ],
            ])
            ->add('middleName', TextType::class, [
                'attr' => [
                    'placeholder' => 'Compagny Name (optional)',
                ],
            ])
            ->add('line1', TextType::class, [
                'attr' => [
                    'placeholder' => 'House number and street name',
                ],
            ])
            ->add('line2', TextType::class, [
                'attr' => [
                    'placeholder' => 'Apartment, suite, unit etc. (optional)',
                ],
            ])
            ->add('city', TextType::class, [
                'attr' => [
                    'placeholder' => 'City',
                ],
            ])
            ->add('province', TextType::class, [
                'attr' => [
                    'placeholder' => 'Stats/Province/Region',
                ],
            ])
            ->add('country', TextType::class, [
                'attr' => [
                    'placeholder' => 'Pays',
                ],
            ])
            ->add('content', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Order notes (optional)',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
