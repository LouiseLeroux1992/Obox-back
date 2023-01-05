<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class ArticleController extends AbstractController
{
    /**
     * Returns a JSON response of all the articles
     * 
     * @Route("/api/articles", name="api_article_browse", methods={"GET"})
     * 
     * @return JsonResponse
     */
    public function browse(ArticleRepository $articleRepository): JsonResponse
    {
        return $this->json(
          // the data
          $articleRepository->findAll(),
          // the HTTP 200 code
          Response::HTTP_OK,
          // the HTTP headers, default [], don't need modifications
          [],
          // the serialization groups
          [
            "groups" =>
            [
                "article_browse"
            ]
          ]
        );
    }

    /**
     * Returns a JSON response of one article by his id and all the themes linked to this article
     * 
     * @Route("/api/articles/{id<\d+>}", name="api_article_read", methods={"GET"})
     * 
     * @param integer $id
     * 
     * @return JsonResponse
     */
    public function read(Article $article = null): JsonResponse
    {
        // If there are no article with this id
        if ($article === null) {
            return $this->json(
                // send an error message
                [
                    "erreur" => "L'article n'a pas été trouvé"
                ],
                // the HTTP 404 code
                Response::HTTP_NOT_FOUND,
                // No need for more parameters
            );
        }

        return $this->json(
          // the data, provided by the param converter
          $article,
          // the HTTP 200 code
          Response::HTTP_OK,
          // the HTTP headers, default [], don't need modifications
          [],
          // the serialization groups
          [
            "groups" =>
            [
                "article_read"
            ]
          ]
        );
    }
}
