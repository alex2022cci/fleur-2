<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Services\EmailServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactFormController extends AbstractController
{
    private $emailServices;

    public function __construct(EmailServices $emailServices)
    {
        $this->emailServices = $emailServices;
    }

    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request): Response
    {

        $Contact = new Contact();
        $form = $this->createForm(ContactType::class, $Contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->emailServices->sendEmail($form, 'contact');
            $this->addFlash('success', 'Votre message a bien été envoyé');
            return $this->redirectToRoute('app_contact');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}