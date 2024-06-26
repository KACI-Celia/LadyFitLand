<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use \App\Repository\EspacesRepository;
use Symfony\Component\Routing\Annotation\Route;

class EspacesController extends AbstractController
{
    #[Route('/espaces', name: 'espaces_salle')]
    public function index(EspacesRepository $espacesRepository): Response
    {
        return $this->render('espaces/espaces.html.twig', [
            'espaces'=>$espacesRepository->findAll(),
        ]);
    }


    #[Route('/espaces/musculation', name: 'espace_musculation')]
    public function musculation(): Response
    {
        return $this->render('espaces/musculation.html.twig', []);
    }



    #[Route('/espaces/coursCollectifs', name: 'espace_coursCollectifs')]
    public function coursCollectifs(): Response
    {
        return $this->render('espaces/coursCollectifs.html.twig', []);
    }

    #[Route('/espaces/cardio', name: 'espace_cardio')]
    public function cardio(): Response
    {
        return $this->render('espaces/cardio.html.twig', []);
    }

    #[Route('/espaces/detente', name: 'espace_detente')]
    public function detente(): Response
    {
        return $this->render('espaces/detente.html.twig', []);
    }
}



