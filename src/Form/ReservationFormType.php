<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Cours;
use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ReservationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateReservation', null, [
                'widget' => 'single_text',
                'label' => 'Date de réservation',
            ])
            ->add('statut', ChoiceType::class, [
                'choices' => [
                    'Confirmée' => 'confirmée',
                    'Annulée' => 'annulée',
                    'En attente' => 'en attente',
                ],
                'label' => 'Statut de la réservation',
            ])
            ->add('User', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'prenomUser',
            ])
            ->add('Cours', EntityType::class, [
                'class' => Cours::class,
                'choice_label' => 'libCours',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
