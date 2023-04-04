<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class MainController extends AbstractController
{

    #[Route('/', name: 'app_main')]
    public function index(ProductRepository $productRepository, CacheInterface $cache): Response
    {
        $newproducts = $cache->get('newproducts', function (ItemInterface $item) use ($productRepository) {
            $item->expiresAfter(3600);
            return $productRepository->FindNewProducts();
        });

        return $this->render('main/index.html.twig', [
            'newproducts' => $newproducts
        ]);
    }
}
