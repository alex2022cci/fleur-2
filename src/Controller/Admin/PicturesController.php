<?php

namespace App\Controller\Admin;

use App\Entity\Pictures;
use App\Form\PicturesType;
use App\Repository\PicturesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/pictures')]
class PicturesController extends AbstractController
{
    #[Route('/', name: 'app_admin_pictures_index', methods: ['GET'])]
    public function index(PicturesRepository $picturesRepository): Response
    {
        return $this->render('admin/pictures/index.html.twig', [
            'pictures' => $picturesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_pictures_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PicturesRepository $picturesRepository): Response
    {
        $picture = new Pictures();
        $form = $this->createForm(PicturesType::class, $picture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $picturesRepository->save($picture, true);

            return $this->redirectToRoute('app_admin_pictures_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/pictures/new.html.twig', [
            'picture' => $picture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_pictures_show', methods: ['GET'])]
    public function show(Pictures $picture): Response
    {
        return $this->render('admin/pictures/show.html.twig', [
            'picture' => $picture,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_pictures_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Pictures $picture, PicturesRepository $picturesRepository): Response
    {
        $form = $this->createForm(PicturesType::class, $picture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $picturesRepository->save($picture, true);

            return $this->redirectToRoute('app_admin_pictures_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/pictures/edit.html.twig', [
            'picture' => $picture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_pictures_delete', methods: ['POST'])]
    public function delete(Request $request, Pictures $picture, PicturesRepository $picturesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$picture->getId(), $request->request->get('_token'))) {
            $picturesRepository->remove($picture, true);
        }

        return $this->redirectToRoute('app_admin_pictures_index', [], Response::HTTP_SEE_OTHER);
    }
}
