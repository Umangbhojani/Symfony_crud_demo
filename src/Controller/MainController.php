<?php

namespace App\Controller;

use App\Entity\Products;
use App\Form\ProductsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/', name: 'app_main')]
    public function index(): Response
    {
        $products = $this->em->getRepository(Products::class)->findAll();

        return $this->render('main/index.html.twig', [
            'products' => $products,
        ]);
    }


    #[Route('/create-product', name: 'add-product')]
    public function CreateProduct(Request $request)
    {
        $products = new Products();
        $form = $this->CreateForm(ProductsType::class, $products);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($products);
            $this->em->flush();
            $this->addFlash('message', 'Product Add Successfully!');

            return $this->redirectToRoute('app_main');
        }

        return $this->render('main/product.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/edit-product/{id}', name: 'edit-product')]
    public function Editproduct(Request $request, $id)
    {
        $products = $this->em->getRepository(Products::class)->find($id);
        $form = $this->createForm(ProductsType::class, $products);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($products);
            $this->em->flush();
            $this->addFlash('message', 'Product Update Successfully!');

            return $this->redirectToRoute('app_main');
        }

        return $this->render('main/product.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/delete-product/{id}', name: 'delete-product')]

    public function deleteproduct($id)
    {
        $products = $this->em->getRepository(Products::class)->find($id);

        $this->em->remove($products);
        $this->em->flush();

        $this->addFlash('message', 'Product Deleted!');
        return $this->redirectToRoute('app_main');
    }
}
