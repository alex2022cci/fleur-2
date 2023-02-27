<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api', name: 'cart_')]
class AddtocartController extends AbstractController
{

    private RequestStack $requestStack;
    private EntityManagerInterface $em;

    public function __construct(RequestStack $requestStack, EntityManagerInterface $em)
    {
        $this->requestStack = $requestStack;
        $this->em = $em;
    }

    #[Route('/add/{id<\d+>}', name: 'index')]
    public function index(int $id): void
    {
        $cart = $this->requestStack->getSession()->get('cart', []);
        if (!empty($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }
        $this->getSession()->set('cart', $cart);

    }


    public function getTotal() 
    {
        $cart = $this->getSession()->get('cart');
        $cartData = [];

        foreach ($cart as $id => $quantity) {
            $product = $this->em->getRepository(Product::class)->findOneBy(['id' => $id]);
            if (!$product) {
                // condition en cas d'erreur
                // par exemple, le produit n'existe pas
                // produit n est plus en stock dans les secondes qui suivent l'ajout au panier
                // etc.
            }	

            $cartData[] = [
                'produit' => $product,
                'quantite' => $quantity,
            ];
        }
    }

    private function getSession(): SessionInterface
    {
        return $this->requestStack->getSession();
    }
}
