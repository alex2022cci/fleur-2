<?php

namespace App\Controller\Profile;

use Knp\Snappy\Pdf;
use App\Entity\Order;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PdfController extends AbstractController
{
    #[Route('/profile/pdf/{id}', name: 'profile_pdf')]
    public function pdfAction(Pdf $knpSnappyPdf, $id, Order $order)
    {
        $html = $this->render('facture/facture.html.twig', [
            'Order'  => $order
        ]);

        return new PdfResponse(
            $knpSnappyPdf->getOutputFromHtml($html),
            'file.pdf'
        );
    }
}