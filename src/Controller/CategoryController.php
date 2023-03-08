<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/category/{slug}', name: 'app_category')]
    public function index($slug, Request $request, PaginatorInterface $paginator, CategoryRepository $CategoryRepository): Response
    {

        $produit = $CategoryRepository->PaginateCategory($slug);
        $query = $produit[0]->getProducts()->getValues();

        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            3 /*limit per page*/
        );

        return $this->render('category/index.html.twig', [
            'produits' => $pagination,
        ]);
    }
}
