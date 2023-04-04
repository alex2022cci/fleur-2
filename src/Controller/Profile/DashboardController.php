<?php

namespace App\Controller\Profile;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class DashboardController extends AbstractController
{
    #[Route('/profile/dashboard', name: 'profile_dashboard')]
    #[isGranted('ROLE_USER')]
    public function index(): Response
    {
        return $this->render('profile/dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
}
