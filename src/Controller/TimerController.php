<?php

namespace App\Controller;

use App\Entity\Timer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\TimerService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use App\Serializer\DoctrineDenormalizer;

class TimerController extends AbstractController
{
    /**
     * Returns a json response of the time left between today and the current user's moving date
     * 
     * @Route("/api/timer", name="api_timer", methods={"GET"})
     * 
     * @return JsonResponse
     */
    public function read(TimerService $timerService, SerializerInterface $serializer): JsonResponse
    {
        // get the current user
        $user = $this->getUser();

        // get the user's timer
        $timer = $user->getTimer();

        if ($timer === null) {
            return $this->json(
                // send an error message
                [
                    "erreur" => "L'utilisateur n'a pas défini sa date de déménagement"
                ],
                // the HTTP 404 code
                Response::HTTP_NOT_FOUND
                // No need for more parameters
            );
        }

        // get the user's moving date
        $movingDate = $timer->getMovingDate();

        // use the timerService to get the time left before moving date
        $timeLeft = $timerService->timer($movingDate);

            // formater la réponse en année-mois-jour
            // $formatedTimeLeft = $timeLeft->format("%Y-%m-%d");
            // dd($formatedTimeLeft);

            // TODO : choisir le format (attention au -0 et +0) condition ? 
        // format the time in number of days if the date is not already passed

        $timerData = $timeLeft->format("%R%a");

        // if ($timerData == "-0" || $timerData == "+0") {
        //     $timerData = "-1";
        // }

        return $this->json(
            // the data
            [
                "timeLeft" => $timerData,
                "timer" => $timer
            ],

            //the HTTP 200 code
            Response::HTTP_OK,
            [],

            // the serialization groups
            [
                "groups" => 
                [
                    "timer_read"
                ]
            ]

        );
    }

    /**
     * Sets the moving date in the current user's timer
     * 
     * @Route("/api/timer/add", name="api_timer_add", methods={"POST"})
     *
     * @return JsonResponse
     */
    public function add(
        Request $request,
        SerializerInterface $serializerInterface,
        ValidatorInterface $validatorInterface,
        EntityManagerInterface $entityManagerInterface
        ): JsonResponse
    {
        // get the current user
        $user = $this->getUser();

        // the data coming from the user : Request
        $jsonContent = $request->getContent();

        // deserialize json from the request with serializer
         try {
            $newTimer = $serializerInterface->deserialize($jsonContent, Timer::class, 'json');
        } catch(Exception $e)
        {
            return $this->json(
                "JSON mal formé",
                Response::HTTP_BAD_REQUEST
            );
        }

        // validate the data with validator
        $errors = $validatorInterface->validate($newTimer);
        if (count($errors) > 0){
            return $this->json(
                $newTimer,
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        // link the timer to the current user
        $newTimer->setUser($user);

        // insert into database
        $entityManagerInterface->persist($newTimer);
        $entityManagerInterface->flush();

        // return JSON
        return $this->json(
            $newTimer,
            Response::HTTP_CREATED,
            [],
            [
                "groups" =>
                [
                    "timer_add"
                ]
            ]
       );
    }

    /**
     * Edits the moving date
     * 
     * @Route("api/timer/{id<\d+>}/edit", name="api_timer_edit", methods={"POST"})
     * 
     * @return JsonResponse
     */
    public function edit(
        ?Timer $timer,
        Request $request,
        SerializerInterface $serializerInterface,
        EntityManagerInterface $entityManagerInterface
    ): JsonResponse
    {
        // If there are no timer with this is
        if ($timer === null) {
            return $this->json(
                // send an error message
                [
                    "erreur" => "Le timer n'a pas été trouvé"
                ],
                // the HTTP 404 code
                Response::HTTP_NOT_FOUND
            );
        }

        // the data coming from the user : Request
        $jsonContent = $request->getContent();

        // deserialize the timer
        $serializerInterface->deserialize(
            $jsonContent,
            Timer::class,
            'json',
            [AbstractNormalizer::OBJECT_TO_POPULATE => $timer]
        );

        // update the database
        $entityManagerInterface->flush();

        // return info that the modification went well
        return $this->json(
            $timer,
            Response::HTTP_OK,
            [],
            [
                "groups" =>
                [
                    "timer_edit"
                ]
            ]
        );
    }
}