<?php

namespace App\Controller\Profile;

use App\Entity\Order;
use App\Form\OrderType;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class ChekoutController extends AbstractController
{
    #[Route('/profile/chekout', name: 'profile_chekout')]
    #[isGranted('ROLE_USER')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        // creation du Formulaire
        $Order = new Order();
        $form = $this->createForm(OrderType::class, $Order);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($Order);
            $em->flush();

            dd($form);
        }

        return $this->render('profile/chekout/index.html.twig', [
            'Order' => $form->createView(),
        ]);
    }

    public function Paiement(): Response
    {
        return $this->render('profile/chekout/paiement.html.twig');
    }
}
