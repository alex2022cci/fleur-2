<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/category/{slug}', name: 'app_category')]
    public function index($slug, Request $request, PaginatorInterface $paginator, ProductRepository $productRepository): Response
    {

        $produit = $productRepository->FindByCategory($slug);

        $pagination = $paginator->paginate(
            $produit,
            $request->query->getInt('page', 1),
            12
        );

        return $this->render('category/index.html.twig', [
            'produits' => $pagination,
        ]);
    }
}
