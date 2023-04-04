<?php

namespace App\Form;

use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, options: [
                'attr' => [
                    'placeholder' => 'First Name',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your first name',
                    ])
                ]
            ])
            ->add('lastName', TextType::class, [
                'attr' => [
                    'placeholder' => 'Last Name',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your last name',
                    ])
                ]
            ])
            ->add('mobile', TelType::class, [
                'attr' => [
                    'placeholder' => 'Mobile',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your mobile',
                    ])
                ]
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
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your address',
                    ])
                ]
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
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your city',
                    ])
                ]
            ])
            ->add('province', TextType::class, [
                'attr' => [
                    'placeholder' => 'Stats/Province/Region',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your state',
                    ])
                ]
            ])
            ->add('country', TextType::class, [
                'attr' => [
                    'placeholder' => 'Pays',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your country',
                    ])
                ]
            ])
            ->add('content', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Order notes (optional)',
                ],
            ])
            ->add('Zip', TextType::class, [
                'attr' => [
                    'placeholder' => 'Your postal code',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your postal code',
                    ]),
                    new  \Symfony\Component\Validator\Constraints\Length([
                        'min' => 3,
                        'max' => 10,
                        'minMessage' => 'Your postal code must be at least {{ limit }} characters long',
                        'maxMessage' => 'Your postal code cannot be longer than {{ limit }} characters',
                    ])
                ]
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
