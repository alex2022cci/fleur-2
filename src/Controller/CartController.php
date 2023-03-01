<?php

namespace App\Controller;


use App\Services\AddtocartServices;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CartController extends AbstractController
{

    private AddtocartServices $AddtocartServices;

    public function __construct(AddtocartServices $AddtocartServices)
    {
        $this->AddtocartServices = $AddtocartServices;
    }

    #[Route('/cart', name: 'app_cart')]
    public function index(): Response
    {
        $items = $this->AddtocartServices->getFullCart();

        $total = $this->AddtocartServices->getTotal();

        return $this->render('cart/cart.html.twig', [
            'items' => $items,
            'total' => $total,
        ]);
    }

}
