<?php

namespace App\Services;

use Stripe\Stripe;

class StripeServives
{
    public function PaiementStripe($success, $cancel, $items)
    {
        $LineItems = [];
        foreach ($items as $item) {
            $LineItems[] =
                [
                    'price_data' => [
                        'currency' => 'eur',
                        'unit_amount' => $item['produit']->getPrice() * 100,
                        'product_data' => [
                            'name' => $item['produit']->getTitle(),
                            'images' => [
                                "https://127.0.0.1:8000/img/product/" . $item['produit']->getPictures()->getValues()[0]->getImageName(),
                            ],
                        ],
                    ],
                    'quantity' => $item['quantity'],
                ];

        }

        $StripeSK = $_ENV['STRIPE_SK'];
        Stripe::setApiKey($StripeSK);

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [$LineItems],
            'mode' => 'payment',
            'success_url' => $success,
            'cancel_url' => $cancel,
        ]);


        return $session;  
        
    }
}