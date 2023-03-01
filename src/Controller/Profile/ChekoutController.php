<?php

namespace App\Controller\Profile;

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
        return $this->render('profile/chekout/index.html.twig', [
            'controller_name' => 'ChekoutController',
        ]);
    }
}
