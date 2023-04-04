<?php

namespace App\Controller\Profile;

use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileOrderController extends AbstractController
{
    public function ViewOrder(OrderRepository $order): Response
    {  
        return $this->render('profile/order/index.html.twig', [
            'history' => $order->findBy(['Utilisateur' => $this->getUser()]),
        ]);
    }
}
