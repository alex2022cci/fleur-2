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

    #[Route('/cart/remove/{id}', name: 'app_cart_remove')]
    public function remove($id): Response
    {
        $this->AddtocartServices->remove($id);
        return $this->redirectToRoute('app_cart');
    }

    public function show_card_right(): Response
    {
        $items = $this->AddtocartServices->getFullCart();
        $total = $this->AddtocartServices->getTotal();

        return $this->render('_partials/show-card-right.html.twig', [
            'items' => $items,
            'total' => $total,
        ]);
    }

    public function show_card_right_empty(): Response
    {
        return $this->render('_partials/show-card-right_empty.html.twig');
    }
}
