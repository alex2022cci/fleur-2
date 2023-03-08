<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/category/{slug}', name: 'app_category')]
    public function index($slug, CategoryRepository $CategoryRepository): Response
    {

        $category = $CategoryRepository->findBy(['Slug' => $slug]);

        return $this->render('category/index.html.twig', [
            'produits' => $category[0]->getProducts()->getValues(),
        ]);
    }
}
