<?php

namespace App\Controller;

use App\Entity\Idees;
use App\Form\IdeesType;
use App\Repository\IdeesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/idees')]
class IdeesController extends AbstractController
{
    #[Route('/', name: 'app_idees_index', methods: ['GET'])]
    public function index(IdeesRepository $ideesRepository): Response
    {
        return $this->render('idees/index.html.twig', [
            'idees' => $ideesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_idees_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $idee = new Idees();
        $form = $this->createForm(IdeesType::class, $idee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($idee);
            $entityManager->flush();

            return $this->redirectToRoute('app_idees_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('idees/new.html.twig', [
            'idee' => $idee,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_idees_show', methods: ['GET'])]
    public function show(Idees $idee): Response
    {
        return $this->render('idees/show.html.twig', [
            'idee' => $idee,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_idees_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Idees $idee, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(IdeesType::class, $idee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_idees_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('idees/edit.html.twig', [
            'idee' => $idee,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_idees_delete', methods: ['POST'])]
    public function delete(Request $request, Idees $idee, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$idee->getId(), $request->request->get('_token'))) {
            $entityManager->remove($idee);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_idees_index', [], Response::HTTP_SEE_OTHER);
    }
}
