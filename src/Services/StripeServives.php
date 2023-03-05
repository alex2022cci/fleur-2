<?php

namespace App\Services;

use Stripe\Stripe;

class StripeServives
{
    Public Function PaiementStripe($success, $cancel)
    {
        // Paiement via Stripe check out
        $StripeSK = 'sk_test_51JjIErKM25X31H2E7SHrvulnw9Buw4oxfoOXEZKwZUUM4xmm1r2tz52pCY0WbIKRvmqMJa1wP5nCqG03PzZnX98X00lYs1piqV';

        Stripe::setApiKey($StripeSK);

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'eur',
                        'unit_amount' => 2000,
                        'product_data' => [
                            'name' => 'T-shirt',
                            'images' => [
                                "https://example.com/t-shirt.png"
                            ],
                        ],
                    ],
                    'quantity' => 1,
                ],[
                    'price_data' => [
                        'currency' => 'eur',
                        'unit_amount' => 2000,
                        'product_data' => [
                            'name' => 'T-shirt',
                            'images' => [
                                "https://example.com/t-shirt.png"
                            ],
                        ],
                    ],
                    'quantity' => 10,
                ],

            ],
            'mode' => 'payment',
            'success_url' => $success,
            'cancel_url' => $cancel,
        ]);

        return $session;  
        
    }
}