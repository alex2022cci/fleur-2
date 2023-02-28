<?php

namespace App\Controller\Http;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ModalController extends AbstractController
{

    #[Route('/ajax/addtocart', name: 'app_modal_addtocart')]
    public function index(Request $request, ProductRepository $productRepository)
    {
        if($request->isXmlHttpRequest() == true) {
            $ModalAddToCart = $productRepository->find($request->query->get('id'));

            // A prevoir l'envoie en sessions pour notre pannier

            $DonneesAEnvoyerALaModal = [
                'image'  => $ModalAddToCart->getPictures()->getValues()[0]->getimageName(),
                'Titre'  => $ModalAddToCart->getTitle(),
                'Slug'   => $ModalAddToCart->getSlug(),
            ];

            return new JsonResponse($DonneesAEnvoyerALaModal);
        }     
    }
}
