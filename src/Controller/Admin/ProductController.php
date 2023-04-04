<?php

namespace App\Controller\Admin;

use DateTimeImmutable;
use App\Entity\Product;
use App\Entity\Pictures;
use App\Form\ProductType;
use App\Repository\UserRepository;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/product')]
class ProductController extends AbstractController
{
    #[Route('/', name: 'app_admin_product_index', methods: ['GET'])]
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('admin/product/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_product_new', methods: ['GET', 'POST'])]
    public function new(UserRepository $user, Request $request, ProductRepository $productRepository, SluggerInterface $slugger): Response
    {

        $User_Id = $user->find($this->getUser()->getId());

        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // recupere les files uploadés
            $images = $request->files->get('files');

            // on boucle les images
            foreach($images as $image) {
                // On donne un nom unique à l'image
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();

                // on ca copiper les images dans le dossier img/product
                $image->move(
                    $this->getParameter('produit_directory'),
                    $fichier
                );
                $img = new Pictures();
                $img->setImageName($fichier);
                $img->setAlt($form->get('Title')->getData());
                $product->addPicture($img);
            }
            $product->setMetaTitle($form->get('Title')->getData());

            // on va créer notre slug avec le titre du produit
            $slug = $slugger->slug($form->get('Title')->getData());
            $product->setSlug($slug);
            $product->setType('1');
            $product->setShop('1');
            $product->setCreatedAt(new DateTimeImmutable());
            $product->setUpdatedAt(new DateTimeImmutable());
            $product->setPublishedAt(new DateTimeImmutable());
            $product->setUserId($User_Id);

            $productRepository->save($product, true);

            return $this->redirectToRoute('app_admin_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/product/new.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_product_show', methods: ['GET'])]
    public function show(Product $product): Response
    {
        return $this->render('admin/product/show.html.twig', [
            'product' => $product,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_product_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Product $product, ProductRepository $productRepository): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productRepository->save($product, true);

            return $this->redirectToRoute('app_admin_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/product/edit.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_product_delete', methods: ['POST'])]
    public function delete(Request $request, Product $product, ProductRepository $productRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $productRepository->remove($product, true);
        }

        return $this->redirectToRoute('app_admin_product_index', [], Response::HTTP_SEE_OTHER);
    }
}
