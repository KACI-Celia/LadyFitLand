<?php

namespace App\Controller;

use App\Entity\Abonnement;
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


    
    //route abonnement principale
    #[Route('/abonnements',name:'frontAbonnement')]

    public function abonnement(AbonnementRepository $abonnementRepository):Response
    {   //dd($id);
       //Récupérer l'abonnement correspondant à partir de $id
        //$abonnement = $abonnementRepository->find($id);
        
        //Vérifier si l'abonnement existe
        //if (!$abonnement) {
            //throw $this->createNotFoundException('Aucun abonnement trouvé pour cet identifiant : '.$id);
        //}

        return $this->render('frontAbonnement/abonnement.html.twig',[
            
            'abonnements' => $abonnementRepository->findAll(),//affichage des abonnements par ordre ascendant
            
            
        ]);
    }

    /*
    ->find($id) => SELECT * FROM abonnement WHERE id = $id
    ->findBy() => SELECT * FROM abonnement WHERE prix = 15.99
    */

    //Routes pour les types d'abonnement coté front:


    //creer un e route detailAbonnement

    #[Route('detail/abonnement/{id}',name:'detail_abonnement')]
    public function DetailAbonnement(AbonnementRepository $abonnementRepository, $id):Response
    {

        //Récupérer l'abonnement correspondant à partir de $id
        $abonnement = $abonnementRepository->find($id);
        
        //Vérifier si l'abonnement existe
        if (!$abonnement) {
            throw $this->createNotFoundException('Aucun abonnement trouvé pour cet identifiant : '.$id);
        }


        return $this->render('frontAbonnement/detailAbonnement.html.twig',[
            'abonnement' => $abonnement,
            //affichage des  détails de l'abonnements 
            //'abonnements'=>$abonnementRepository->findBy([],['prix'=> 'ASC'])
            
        ]);
    }

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
