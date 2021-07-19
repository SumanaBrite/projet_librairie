<?php

namespace App\Controller;

use App\Entity\ArticleStock;
use App\Form\ArticleStockType;
use App\Repository\ArticleStockRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/article/stock")
 */
class ArticleStockController extends AbstractController
{
    /**
     * @Route("/", name="article_stock_index", methods={"GET"})
     */
    public function index(ArticleStockRepository $articleStockRepository): Response
    {
        return $this->render('article_stock/index.html.twig', [
            'article_stocks' => $articleStockRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="article_stock_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $articleStock = new ArticleStock();
        $form = $this->createForm(ArticleStockType::class, $articleStock);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($articleStock);
            $entityManager->flush();

            return $this->redirectToRoute('article_stock_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('article_stock/new.html.twig', [
            'article_stock' => $articleStock,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="article_stock_show", methods={"GET"})
     */
    public function show(ArticleStock $articleStock): Response
    {
        return $this->render('article_stock/show.html.twig', [
            'article_stock' => $articleStock,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="article_stock_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ArticleStock $articleStock): Response
    {
        $form = $this->createForm(ArticleStockType::class, $articleStock);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('article_stock_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('article_stock/edit.html.twig', [
            'article_stock' => $articleStock,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="article_stock_delete", methods={"POST"})
     */
    public function delete(Request $request, ArticleStock $articleStock): Response
    {
        if ($this->isCsrfTokenValid('delete'.$articleStock->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($articleStock);
            $entityManager->flush();
        }

        return $this->redirectToRoute('article_stock_index', [], Response::HTTP_SEE_OTHER);
    }
}
