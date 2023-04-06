<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product/{Slug}', name: 'app_product')]
    public function index(Product $Product, CategoryRepository $category): Response
    {
        return $this->render('product/index.html.twig', [
            'produit' => $Product,
            'lastProducts' => $category->find($Product->getCategory()->getId())->getProducts()
        ]);
    }
}
