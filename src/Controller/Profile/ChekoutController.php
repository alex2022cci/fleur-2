<?php

namespace App\Controller\Profile;

use App\Entity\Order;
use App\Form\OrderType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class ChekoutController extends AbstractController
{
    #[Route('/profile/chekout', name: 'profile_chekout')]
    #[isGranted('ROLE_USER')]
    public function index(): Response
    {
        // creation du Formulaire
        $Order = new Order();
        $form = $this->createForm(OrderType::class, $Order);

        return $this->render('profile/chekout/index.html.twig', [
            'Order' => $form->createView(),
        ]);
    }
}
