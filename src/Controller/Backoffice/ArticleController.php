<?php

namespace App\Controller\Backoffice;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/backoffice/article")
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_backoffice_article_index", methods={"GET"})
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('backoffice/article/index.html.twig', [
            'articles' => $articleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_backoffice_article_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ArticleRepository $articleRepository, SluggerInterface $slugger): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // create the slug for the article
            $slug = $slugger->slug($article->getTitle());
            $article->setSlug($slug);

            $articleRepository->add($article, true);

            return $this->redirectToRoute('app_backoffice_article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backoffice/article/new.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_backoffice_article_show", methods={"GET"})
     */
    public function show(Article $article): Response
    {
        return $this->render('backoffice/article/show.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_backoffice_article_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Article $article, ArticleRepository $articleRepository, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // modify the slug for the article
            $slug = $slugger->slug($article->getTitle());
            $article->setSlug($slug);

            $articleRepository->add($article, true);

            return $this->redirectToRoute('app_backoffice_article_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backoffice/article/edit.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_backoffice_article_delete", methods={"POST"})
     */
    public function delete(Request $request, Article $article, ArticleRepository $articleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $articleRepository->remove($article, true);
        }

        return $this->redirectToRoute('app_backoffice_article_index', [], Response::HTTP_SEE_OTHER);
    }
}
