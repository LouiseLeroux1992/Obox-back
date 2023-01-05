<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Entity\Task;
use App\Repository\ReserveTaskRepository;
use App\Repository\TaskRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class TodolistController extends AbstractController
{
    /**
     * Returns a JSON response of all the user's tasks
     * 
     * @Route("/api/todolist", name="api_todolist_browse", methods={"GET"})
     * 
     * @return JsonResponse
     */
    public function browse(TaskRepository $taskRepository): JsonResponse
    {
        $user = $this->getUser();
        $userId = $user->getId();
        
        return $this->json(
            // the data
            $taskRepository->findByUser($userId),
            // the HTTP 200 code
            Response::HTTP_OK,
            // the HTTP headers, default [], don't need modifications
            [],
            // the serialization groups
            [
              "groups" =>
              [
                  "todolist_browse"
              ]
            ]
        );
    }

    /**
     * Returns a JSON response of one task found by its Id
     * 
     * @Route("/api/todolist/{id<\d+>}", name="api_todolist_read", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function read(Task $task): JsonResponse
    {
        // If there are no task with this id
        if ($task === null) {
            return $this->json(
                // send an error message
                [
                    "erreur" => "La tâche n'a pas été trouvée"
                ],
                // the HTTP 404 code
                Response::HTTP_NOT_FOUND,
                // No need for more parameters
            );
        }

        return $this->json(
            // the data
            $task,
            // the HTTP 200 code
            Response::HTTP_OK,
            // the HTTP headers, default [], don't need modifications
            [],
            // the serialization groups
            [
              "groups" =>
              [
                  "todolist_read"
              ]
            ]
        );
    }

    /**
     * Creates a new task
     * 
     * @Route("/api/todolist/add", name="api_todolist_add", methods={"POST"})
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
        // the data coming from the user : Request
        $jsonContent = $request->getContent();

        // deserialize json from the request with serializer
        try {
            $newTask = $serializerInterface->deserialize($jsonContent, Task::class, 'json');
        } catch(Exception $e)
        {
            return $this->json(
                "JSON mal formé",
                Response::HTTP_BAD_REQUEST
            );
        }

        // validate the data with validator
        $errors = $validatorInterface->validate($newTask);
        if (count($errors) > 0){
            return $this->json(
                $newTask,
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        // link the task to the current user
        $user = $this->getUser();

        $newTask->setUser($user);

        // insert into database : EntityManager / Repository
        $entityManagerInterface->persist($newTask);
        $entityManagerInterface->flush();

        // return JSON
        return $this->json(
            $newTask,
            Response::HTTP_CREATED,
            [],
            [
                "groups" =>
                [
                    "todolist_add"
                ]
            ]
        );
    }

    /**
     * Changes the values of a task
     * 
     * @Route("/api/todolist/{id<\d+>}/edit", name="api_todolist_edit", methods={"PATCH"})
     *
     * @return JsonResponse
     */
    public function edit(
        ?Task $task,
        Request $request,
        SerializerInterface $serializerInterface,
        EntityManagerInterface $entityManagerInterface
    ): JsonResponse
    {
        // If there are no task with this id
        if ($task === null) {
            return $this->json(
                // send an error message
                [
                    "erreur" => "La tâche n'a pas été trouvée"
                ],
                // the HTTP 404 code
                Response::HTTP_NOT_FOUND
                // No need for more parameters
            );
        }

        // the data coming from the user : Request
        $jsonContent = $request->getContent();

        // deserialize the task
        $serializerInterface->deserialize(
            $jsonContent,
            Task::class,
            'json',
            // with the context parameter, enter the object to update
            [AbstractNormalizer::OBJECT_TO_POPULATE => $task]
        );

        // update the database
        $entityManagerInterface->flush();

        // return info that the modification went well
        return $this->json(
            $task,
            Response::HTTP_PARTIAL_CONTENT,
            [],
            [
                "groups" =>
                [
                    "todolist_edit"
                ]
            ]
        );
    }

    /**
     * Deletes a task
     * 
     * @Route("/api/todolist/{id<\d+>}/delete", name="api_todolist_delete", methods={"DELETE"})
     *
     * @return JsonResponse
     */
    public function delete(
        Request $request, 
        Task $task, 
        TaskRepository $taskRepository,
        EntityManagerInterface $entityManagerInterface
        ): JsonResponse
    {
        // remove task from database
        $taskRepository->remove($task, true);
        
        // update database
        $entityManagerInterface->flush();

        return $this->json(
            "la tâche a bien été supprimée",
            Response::HTTP_OK
        );
    }

    /**
     * Links a tag to the current user and copies the corresponding UserTasks to create new tasks for the current user. 
     * 
     * @Route("/api/todolist/tag/{id<\d+>}/add", name="api_todolist_tag_add_task", methods={"POST"})
     *
     * @return JsonResponse
     */
    public function tagAddTask(
        Tag $tag,
        EntityManagerInterface $entityManagerInterface,
        ReserveTaskRepository $reserveTaskRepository,
        TaskRepository $taskRepository
        ): JsonResponse
    {
        // get the current user
        $user = $this->getUser();
        $userId = $user->getId();

        // link the tag to the current user
        $user->addTag($tag);

        // copy the reserveTask linked to this tag
        $reserveTasks = $reserveTaskRepository->findByTag($tag);

        foreach($reserveTasks as $reserveTask){
            $newTasks[] = task::createfrom($reserveTask);
        }

        foreach($newTasks as $newTask){
            $newTask->setUser($user);
            $entityManagerInterface->persist($newTask);
        }

        // update the database
        $entityManagerInterface->flush();

        return $this->json(
            // the data
            $taskRepository->findByUser($userId),
            // the HTTP 200 code
            Response::HTTP_OK,
            // the HTTP headers, default [], don't need modifications
            [],
            // the serialization groups
            [
              "groups" =>
              [
                  "todolist_browse"
              ]
            ]
        );
    }

    /**
     * Deletes all tasks that are linked to the unchecked tag from the current user's todolist 
     * 
     * @Route("/api/todolist/tag/{id<\d+>}/deletetask", name="api_todolist_tag_delete_task", methods={"DELETE"})
     *
     * @return JsonResponse
     */
    public function tagDeleteTask(
        Tag $tag, 
        TaskRepository $taskRepository,
        UserRepository $userRepository,
        EntityManagerInterface $entityManagerInterface
        ): JsonResponse
    {
        // get the current user
        $user = $this->getUser();
        $userId = $user->getId();

        // get the unchecked tag
        $tagId = $tag->getId();

        // get the current user's tasks that are linked to the unchecked tag
        $tasksToDelete = $taskRepository->findByUserAndTag($userId, $tagId);

        foreach($tasksToDelete as $taskToDelete){
            $taskRepository->remove($taskToDelete, true);
        }

        // remove the link between the user and the tag
        $user->removeTag($tag);

        // update database
        $entityManagerInterface->flush();

        return $this->json(
            // the data
            $taskRepository->findByUser($userId),
            // the HTTP 200 code
            Response::HTTP_OK,
            // the HTTP headers, default [], don't need modifications
            [],
            // the serialization groups
            [
              "groups" =>
              [
                  "todolist_browse"
              ]
            ]
        );
    }
}
