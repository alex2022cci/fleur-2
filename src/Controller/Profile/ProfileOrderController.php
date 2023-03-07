<?php

namespace App\Controller\Profile;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileOrderController extends AbstractController
{
    #[Route('/order', name: 'profile_order')]
    public function index(): Response
    {
        return $this->render('profile/order/index.html.twig', [
            'controller_name' => 'OrderController',
        ]);
    }
}
