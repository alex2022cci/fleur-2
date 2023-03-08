<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class MenuController extends AbstractController
{
    public function index(CategoryRepository $menu): Response
    {
       return $this->render('_partials/ltn__header-top-area.html.twig', [
        'items' => $menu->findAll()
       ]);
    }
}
