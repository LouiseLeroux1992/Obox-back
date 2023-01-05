<?php

namespace App\Controller;

use App\Entity\Theme;
use App\Repository\ThemeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ThemeController extends AbstractController
{
    /**
     * Returns a JSON response of all themes
     * 
     * @Route("/api/articles/themes", name="api_theme_browse", methods={"GET"})
     * 
     * @return JsonResponse
     */
    public function browse(ThemeRepository $themeRepository): JsonResponse
    {
        return $this->json(
            // the data
            $themeRepository->findAll(),
            // the HTTP 200 code
            Response::HTTP_OK,
            // the HTTP headers, default [],  don't need modifications
            [],
            // the serialization groups
            [
                "groups" => 
                [
                    "theme_browse"
                ]
            ]
        );
    }

    /**
     * Returns a JSON response of one theme by his id and all the articles linked to this theme
     * 
     * @Route("/api/articles/themes/{id<\d+>}", name="api_theme_read", methods={"GET"})
     * 
     * @param integer $id
     * 
     * @return JsonResponse
     */
    public function read(Theme $theme = null): JsonResponse
    {
        // If there are no theme with this id
        if ($theme === null) {
            return $this->json(
                // send an error message
                [
                    "erreur" => "Le thème n'a pas été trouvé"
                ],
                // the HTTP 404 code
                Response::HTTP_NOT_FOUND,
                // No need for more parameters
            );
        }

        return $this->json(
            // the data
            $theme,
            // the HTTP 200 code
            Response::HTTP_OK,
            // the HTTP headers
            [],
            // the serialization groups
            [
                "groups" =>
                [
                    "theme_read"
                ]
            ]
        );
    }
}
