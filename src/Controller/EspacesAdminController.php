<?php

namespace App\Controller;

use App\Entity\Espaces;
use App\Form\EspacesType;
use App\Repository\EspacesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/espaces/admin')]
class EspacesAdminController extends AbstractController
{
    #[Route('/', name: 'app_espaces_admin_index', methods: ['GET'])]
    public function index(EspacesRepository $espacesRepository): Response
    {
        return $this->render('espaces_admin/index.html.twig', [
            'espaces' => $espacesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_espaces_admin_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $espace = new Espaces();
        $form = $this->createForm(EspacesType::class, $espace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($espace);
            $entityManager->flush();

            return $this->redirectToRoute('app_espaces_admin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('espaces_admin/new.html.twig', [
            'espace' => $espace,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_espaces_admin_show', methods: ['GET'])]
    public function show(Espaces $espace): Response
    {
        return $this->render('espaces_admin/show.html.twig', [
            'espace' => $espace,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_espaces_admin_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Espaces $espace, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EspacesType::class, $espace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_espaces_admin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('espaces_admin/edit.html.twig', [
            'espace' => $espace,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_espaces_admin_delete', methods: ['POST'])]
    public function delete(Request $request, Espaces $espace, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$espace->getId(), $request->request->get('_token'))) {
            $entityManager->remove($espace);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_espaces_admin_index', [], Response::HTTP_SEE_OTHER);
    }
}
