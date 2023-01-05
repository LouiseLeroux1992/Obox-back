<?php

namespace App\Controller\Backoffice;

use App\Entity\ReserveTask;
use App\Form\ReserveTaskType;
use App\Repository\ReserveTaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backoffice/reservetask")
 */
class ReserveTaskController extends AbstractController
{
    /**
     * @Route("/", name="app_backoffice_reserve_task_index", methods={"GET"})
     */
    public function index(ReserveTaskRepository $reserveTaskRepository): Response
    {
        return $this->render('backoffice/reserve_task/index.html.twig', [
            'reserve_tasks' => $reserveTaskRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_backoffice_reserve_task_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ReserveTaskRepository $reserveTaskRepository): Response
    {
        $reserveTask = new ReserveTask();
        $form = $this->createForm(ReserveTaskType::class, $reserveTask);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reserveTaskRepository->add($reserveTask, true);

            return $this->redirectToRoute('app_backoffice_reserve_task_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backoffice/reserve_task/new.html.twig', [
            'reserve_task' => $reserveTask,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_backoffice_reserve_task_show", methods={"GET"})
     */
    public function show(ReserveTask $reserveTask): Response
    {
        return $this->render('backoffice/reserve_task/show.html.twig', [
            'reserve_task' => $reserveTask,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_backoffice_reserve_task_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ReserveTask $reserveTask, ReserveTaskRepository $reserveTaskRepository): Response
    {
        $form = $this->createForm(ReserveTaskType::class, $reserveTask);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reserveTaskRepository->add($reserveTask, true);

            return $this->redirectToRoute('app_backoffice_reserve_task_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backoffice/reserve_task/edit.html.twig', [
            'reserve_task' => $reserveTask,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_backoffice_reserve_task_delete", methods={"POST"})
     */
    public function delete(Request $request, ReserveTask $reserveTask, ReserveTaskRepository $reserveTaskRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reserveTask->getId(), $request->request->get('_token'))) {
            $reserveTaskRepository->remove($reserveTask, true);
        }

        return $this->redirectToRoute('app_backoffice_reserve_task_index', [], Response::HTTP_SEE_OTHER);
    }
}
