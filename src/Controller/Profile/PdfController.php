<?php

namespace App\Controller\Profile;

use App\Entity\Order;
use Knp\Snappy\Pdf;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PdfController extends AbstractController
{
    #[Route('/profile/pdf/{id}', name: 'profile_pdf')]
    public function pdfAction(Pdf $knpSnappyPdf, $id, Order $order)
    {
        dd($order);

        $html = $this->renderView('facture/facture.html.twig', [
            'some'  => $vars
        ]);

        return new PdfResponse(
            $knpSnappyPdf->getOutputFromHtml($html),
            'file.pdf'
        );
    }
}