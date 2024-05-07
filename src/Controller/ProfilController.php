<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditProfileUserFormType;
use App\Form\EditUserPasswordFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/profil')]
class ProfilController extends AbstractController
{
    #[Route('/', name: 'app_profil_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('profil/index.html.twig');
    }

    #[Route('/modifier', name: 'app_profil_edit', methods: ['GET', 'POST'])]

    public function edit(Request $request, EntityManagerInterface $entityManager): Response
    {   //formulaire de modification de profil
        $user = $this->getUser();
        $form = $this->createForm(EditProfileUserFormType::class, $user, [

        ]);
        $form->handleRequest($request);//association au formulaire les données de la requette
        //si le formulaire est soulmis et validé
        if ($form->isSubmitted() && $form->isValid()) {

            // $entityManager->persist($user);
            $entityManager->flush();
            $this->addflash('success','le profil a été modifié');

            return $this->redirectToRoute('app_profil_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('profil/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/modifier/password', name: 'app_profil_edit_password', methods: ['GET', 'POST'])]
    public function editPassword(Request $request, UserPasswordHasherInterface $hasher, EntityManagerInterface $em):Response
    {
        $user = $this->getUser();
        $form = $this->createForm(EditUserPasswordFormType::class, null, [
            
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted()&& $form->isValid())
        {
            $plainPassword = $form->getData()['plainPassword'];
            $passwordHashed = $hasher->hashPassword($user, $plainPassword);

            $user->setPassword($passwordHashed);

            $em->persist($user);
            $em->flush();
            $this->addflash('success','le profil a été modifié');

            return $this->redirectToRoute('app_profil_index');
        }
            

        return $this->render('profil/edit_password.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/supprimer', name: 'app_profil_delete', methods: ['GET','POST'])]
    public function delete(Request $request,  EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        $this->addFlash('success',"{$user->getPrenomUser()} {$user->getNomUser()} a été supprimé!");
        if ($this->isCsrfTokenValid('delete_profile', $request->request->get('csrf_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_register', [], Response::HTTP_SEE_OTHER);
    }
}
