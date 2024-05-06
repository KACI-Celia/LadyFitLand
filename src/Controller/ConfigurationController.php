<?php

namespace App\Controller;

use App\Entity\Configuration;
use App\Form\ConfigurationType;
use App\Repository\ConfigurationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/configuration')]
class ConfigurationController extends AbstractController
{
    #[Route('/', name: 'app_configuration_index', methods: ['GET'])]
    public function index(ConfigurationRepository $configurationRepository): Response
    {
        return $this->render('configuration/index.html.twig', [
            'configurations' => $configurationRepository->findAll(),
        ]);
    }
    #[Route('/adresse', name:'adresse_salle')]
    public function adresse(){
        return $this->render('configuration/adresse.html.twig');
    }

    #[Route('/new', name: 'app_configuration_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $configuration = new Configuration();
        $form = $this->createForm(ConfigurationType::class, $configuration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($configuration);
            $entityManager->flush();

            return $this->redirectToRoute('app_configuration_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('configuration/new.html.twig', [
            'configuration' => $configuration,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_configuration_show', methods: ['GET'])]
    public function show(Configuration $configuration): Response
    {
        return $this->render('configuration/show.html.twig', [
            'configuration' => $configuration,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_configuration_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Configuration $configuration, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ConfigurationType::class, $configuration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_configuration_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('configuration/edit.html.twig', [
            'configuration' => $configuration,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_configuration_delete', methods: ['POST'])]
    public function delete(Request $request, Configuration $configuration, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$configuration->getId(), $request->request->get('_token'))) {
            $entityManager->remove($configuration);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_configuration_index', [], Response::HTTP_SEE_OTHER);
    }
}
