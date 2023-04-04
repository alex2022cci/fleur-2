<?php

namespace App\Controller\Http;

use App\Services\AddtocartServices;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ModalController extends AbstractController
{

    private AddtocartServices $AddtocartServices;

    public function __construct(AddtocartServices $AddtocartServices)
    {
        $this->AddtocartServices = $AddtocartServices;
    }
    
    #[Route('/ajax/addtocart', name: 'app_modal_addtocart')]
    public function index(Request $request, ProductRepository $productRepository)
    {
        if($request->isXmlHttpRequest() == true) {
            $ModalAddToCart = $productRepository->findOneBy(
                [
                    'Slug' => $request->query->get('id')
                ]
            );

            // A prevoir l'envoie en sessions pour notre pannier
           $this->AddtocartServices->add($ModalAddToCart->getId());

            $DonneesAEnvoyerALaModal = [
                'image'  => $ModalAddToCart->getPictures()->getValues()[0]->getimageName(),
                'Titre'  => $ModalAddToCart->getTitle(),
                'Slug'   => $ModalAddToCart->getSlug(),
            ];

            return new JsonResponse($DonneesAEnvoyerALaModal);
        }     
    }
}
