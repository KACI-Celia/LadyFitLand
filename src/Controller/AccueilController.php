<?php

namespace App\Controller;

use App\Repository\AbonnementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('', name: 'page_principale')]
    public function accueil(): Response
    {
        return $this->render('accueil/accueil.html.twig', []);
    }

    #[Route('abonnements',name:'frontAbonnement')]
    public function abonnement(AbonnementRepository $abonnementRepository):Response
    {
        return $this->render('frontAbonnement/abonnement.html.twig',[
            'abonnements' => $abonnementRepository->findBy([], ['prix' => 'ASC']),//affichage des abonnements par ordre ascendant
        ]);
    }

    /*
    ->find($id) => SELECT * FROM abonnement WHERE id = $id
    ->findBy() => SELECT * FROM abonnement WHERE prix = 15.99


    */

    #[Route('abonnementClassic',name:'abonnement_classic')]
    public function abonnementClassic():Response
    {
        return $this->render('frontAbonnement/abonnementClassic.html.twig');
    }

    #[Route('abonnementDuo',name:'abonnement_duo')]
    public function abonnementduo():Response
    {
        return $this->render('frontAbonnement/abonnementDuo.html.twig');
    }

    #[Route('abonnementVip',name:'abonnement_vip')]
    public function abonnemenVip():Response
    {
        return $this->render('frontAbonnement/abonnementVip.html.twig');
    }
}
