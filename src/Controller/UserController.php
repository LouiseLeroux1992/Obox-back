<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserController extends AbstractController
{
    /**
     * Add User
     * 
     * @Route("/signup", name="api_user_signup", methods={"POST"})
     */
    public function add(
        Request $request, 
        SerializerInterface $serializerInterface, 
        ValidatorInterface $validatorInterface, 
        EntityManagerInterface $entityManagerInterface,
        UserPasswordHasherInterface $userPasswordHasher
        ): Response
    {
        // the data coming from the user : Request
        $jsonContent = $request->getContent();

        // deserialize json from the request with serializerInterface
        try {
            $newUser = $serializerInterface->deserialize($jsonContent, User::class, 'json');
        } catch(Exception $e)
        {
            return $this->json(
                "JSON mal formé",
                Response::HTTP_BAD_REQUEST
            );
        }

        // validate the data : ValidatorInterface
        $errors = $validatorInterface->validate($newUser);
        if (count($errors) > 0){
            return $this->json(
                $newUser,
                Response::HTTP_UNPROCESSABLE_ENTITY,
                [],
                // TODO voir l'utilité de ce  user_error
                ["groups" => ["user_error_add"]]
            );
        }

        $passwordHashed = $userPasswordHasher->hashPassword($newUser, $newUser->getPassword());
        $newUser->setPassword($passwordHashed);

        // insert into database : EntityManagerInterface / Repository
        $entityManagerInterface->persist($newUser);
        $entityManagerInterface->flush();

        // return JSON
        return $this->json(
            $newUser,
            Response::HTTP_CREATED,
            [],
            [
                "groups" =>
                [
                    "user_add"
                ]
            ]
        );
    }

    /**
     * Returns a JSON response of the current user
     * 
     * @Route("/api/currentuser", name="api_user_read", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function read(): JsonResponse
    {
        // get the current user
        $user = $this->getUser();

        return $this->json(
            // the data
            $user,
            // the HTTP 200 code 
            Response::HTTP_OK,
            // the headers
            [],
            // the serialization groups
            [
                "groups" =>
                [
                    "user_read"
                ]
            ]
        );
    }
}
