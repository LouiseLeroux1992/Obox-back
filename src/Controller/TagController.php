<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\TagRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TagController extends AbstractController
{
    /**
     * Returns a json response of all tags
     * 
     * @Route("/api/tags", name="api_tag_browse", methods={"GET"})
     * 
     * @return JsonResponse
     */
    public function browse(TagRepository $tagRepository): JsonResponse
    {
        $user = $this->getUser();

        $allTags = $tagRepository->findAll();
        $userTags = $user->getTags()->toArray();

        foreach($allTags as $tag){
            if(in_array($tag, $userTags)){
                $tag->setChecked(true);
            }
        }

        return $this->json(
            // the data
            $allTags,
            // the HTTP 200 code
            Response::HTTP_OK,
            // the HTTP headers, default [], don't need modification
            [],
            // the sserialization groups
            [
                "groups" =>
                [
                    "tag_browse"
                ]
            ]

        );
    }
}
