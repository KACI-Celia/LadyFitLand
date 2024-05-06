<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;


class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $manager, MailerInterface $mailer): Response
    {
            $contact = new Contact();
            $form = $this->createForm(ContactType::class, $contact);

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $contact = $form->getData();

                $manager->persist($contact);
                $manager->flush();

                //Email(envoi des emails lors de l'envoie du formulaire de contact)
                    $email = (new TemplatedEmail())
                    ->from($contact->getEmail())
                    ->to('LadyFitLand@gmail.com')
                    ->subject($contact->getSujet())
                     // path of the Twig template to render
                    ->htmlTemplate('emails/contact.html.twig')

                    // change locale used in the template, e.g. to match user's locale
                    ->locale('de')

                    // pass variables (name => value) to the template
                    ->context([
                        'contact'=>$contact
                    ]);

                    $mailer->send($email);

                $this->addFlash(
                    'success',
                    'Votre demande à été envoyée'
                );
            }

        return $this->render('contact/index.html.twig', [
            'form'=>$form->createView(),
        ]);
    }
}
