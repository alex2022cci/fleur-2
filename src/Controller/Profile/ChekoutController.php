<?php

namespace App\Controller\Profile;

use Stripe\Stripe;
use App\Entity\Cart;
use App\Entity\Order;
use App\Form\OrderType;
use App\Services\StripeServives;
use App\Repository\UserRepository;
use App\Repository\OrderRepository;
use App\Services\AddtocartServices;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ChekoutController extends AbstractController
{
    private AddtocartServices $AddtocartServices;
    private StripeServives $StripeServives;

    public function __construct(AddtocartServices $AddtocartServices, StripeServives $StripeServives)
    {
        $this->AddtocartServices = $AddtocartServices;
        $this->StripeServives = $StripeServives;
    }

    #[Route('/profile/chekout', name: 'profile_chekout')]
    #[isGranted('ROLE_USER')]
    public function index(Request $request, EntityManagerInterface $em, UserRepository $user): Response
    {
        // creation du Formulaire
        $Order = new Order();
        $form = $this->createForm(OrderType::class, $Order);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $Order->setUtilisateur($user->find($this->getUser()->getId()));
            $em->persist($Order);
            $em->flush();

            return $this->redirectToRoute('profile_paiement');
        }

        return $this->render('profile/chekout/index.html.twig', [
            'Order' => $form->createView(),
        ]);
    }

    #[Route('/proppfile/paiement', name: 'profile_paiement')]

    public function Paiement(Request $request): Response
    {
        // Je créer le btn submit dans le formulaire de paiement
        // pour avoir du code différent et d'autre possibilité je fais le formulaire dans le controller
        // et non dans le répertoir form
        // PS: A EVITE DE FAIRE COMME CELA
        $form = $this->createFormBuilder()
                        ->add('submit', SubmitType::class, [
                            'attr' => [
                                'class' => 'btn theme-btn-1 btn-effect-1 text-uppercase'
                            ]
                        ])->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $success = $this->generateUrl('success_url', [], UrlGeneratorInterface::ABSOLUTE_URL);
            $cancel =  $this->generateUrl('cancel_url', [], UrlGeneratorInterface::ABSOLUTE_URL);
            $ValidStripe  = $this->StripeServives->PaiementStripe($success, $cancel, $this->AddtocartServices->getFullCart());
            return $this->redirect($ValidStripe->url, 303);

        }

        return $this->render('profile/chekout/paiement.html.twig', [
            'items' => $this->AddtocartServices->getFullCart(),
            'total' => $this->AddtocartServices->getTotal(),
            'form' => $form->createView(),
        ]);
    }

    #[Route('/profile/success', name: 'success_url')]
    #[isGranted('ROLE_USER')]
    public function success_url(OrderRepository $order, ManagerRegistry $em): Response
    {
        $UpdateOrder = $order->findOneBy(
            ['Utilisateur' => $this->getUser()->getId()],
            ['id' => 'DESC']
        );

        if(!$UpdateOrder) {
            throw $this->createNotFoundException('L\'utilisateur n existe pas');
        }

        $UpdateOrder->setStatus(1); // 1 = payé
        $UpdateOrder->setTax('0.2');
        $UpdateOrder->setTotal($this->AddtocartServices->getTotal());
        $UpdateOrder->setSubTotal($this->AddtocartServices->getTotal() / 1.2); // affiche le montant HT
        
        foreach($this->AddtocartServices->getFullCart() as $carts) {
            $cart = new Cart();
            $cart->setTitle($carts['produit']->getTitle());
            $cart->setPrice($carts['produit']->getPrice());
            $cart->setQuantity($carts['quantity']);
            $cart->setSKU($carts['produit']->getSKU());
            $cart->setDiscount($carts['produit']->getDiscount());
            $cart->setOrders($UpdateOrder);
            $em->getManager()->persist($cart);
        }

        dd($em->getConnection()->beginTransaction());
        try {
            $em->getManager()->flush();
        } catch (\Exception $e) {
            throw $e;
        }

         return $this->render('profile/chekout/paiement_success.html.twig', [
            'total' => $this->AddtocartServices->getTotal()
        ]);
    }

    #[Route('/profile/cancel', name: 'cancel_url')]
    #[isGranted('ROLE_USER')]
    public function cancel_url(): Response
    {
        return $this->render('profile/chekout/paiement_cancel.html.twig');
    }


}
