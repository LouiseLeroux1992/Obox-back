<?php

namespace App\Controller\Backoffice;

use App\Entity\Theme;
use App\Form\ThemeType;
use App\Repository\ThemeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/backoffice/theme")
 */
class ThemeController extends AbstractController
{
    /**
     * @Route("/", name="app_backoffice_theme_index", methods={"GET"})
     */
    public function index(ThemeRepository $themeRepository): Response
    {
        return $this->render('backoffice/theme/index.html.twig', [
            'themes' => $themeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_backoffice_theme_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ThemeRepository $themeRepository, SluggerInterface $slugger): Response
    {
        $theme = new Theme();
        $form = $this->createForm(ThemeType::class, $theme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // create the slug for the theme
            $slug = $slugger->slug($theme->getName());
            $theme->setSlug($slug);

            $themeRepository->add($theme, true);

            return $this->redirectToRoute('app_backoffice_theme_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backoffice/theme/new.html.twig', [
            'theme' => $theme,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_backoffice_theme_show", methods={"GET"})
     */
    public function show(Theme $theme): Response
    {
        return $this->render('backoffice/theme/show.html.twig', [
            'theme' => $theme,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_backoffice_theme_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Theme $theme, ThemeRepository $themeRepository, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(ThemeType::class, $theme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // modify the slug for the theme
            $slug = $slugger->slug($theme->getName());
            $theme->setSlug($slug);

            $themeRepository->add($theme, true);

            return $this->redirectToRoute('app_backoffice_theme_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('backoffice/theme/edit.html.twig', [
            'theme' => $theme,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_backoffice_theme_delete", methods={"POST"})
     */
    public function delete(Request $request, Theme $theme, ThemeRepository $themeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$theme->getId(), $request->request->get('_token'))) {
            $themeRepository->remove($theme, true);
        }

        return $this->redirectToRoute('app_backoffice_theme_index', [], Response::HTTP_SEE_OTHER);
    }
}
