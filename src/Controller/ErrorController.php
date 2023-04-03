<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ErrorController extends AbstractController
{
    public function __construct(
        private LoggerInterface $logger
    ){}

    #[Route('/error', name: 'app_error')]
    public function index(): Response
    {
        $this->logger->debug('debug page : ');
        $this->logger->info('info page : ');
        $this->logger->notice('notice page : ');
        $this->logger->warning('warning page : ');
        $this->logger->error('error page : ');
        $this->logger->critical('critical page : ');
        $this->logger->alert('alert page : ');
        $this->logger->emergency('emergency page : ');

        return $this->render('error/index.html.twig', [

        ]);
    }
}
