<?php

namespace App\Form;

use App\Entity\Abonnement;
use App\Entity\Cours;
use App\Entity\Espaces;
use App\Entity\Idees;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class User1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('roles')
            ->add('is_verified')
            ->add('resetToken')
            ->add('nomUser')
            ->add('prenomUser')
            ->add('dateNaissanceUser', null, [
                'widget' => 'single_text',
            ])
            ->add('adresseUser')
            ->add('zipcode')
            ->add('city')
            ->add('adresseFacturationUser')
            ->add('telUser')
            ->add('email')
            ->add('password')
            ->add('Cours', EntityType::class, [
                'class' => Cours::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('Abonnement', EntityType::class, [
                'class' => Abonnement::class,
                'choice_label' => 'id',
            ])
            ->add('Idees', EntityType::class, [
                'class' => Idees::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('Espaces', EntityType::class, [
                'class' => Espaces::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
