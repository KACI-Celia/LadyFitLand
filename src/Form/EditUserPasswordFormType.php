<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class EditUserPasswordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('currentPassword', PasswordType::class,[
                'required'=>false,
                'constraints'=>[
                    new UserPassword([
                        "message"=>"Le mot de passe actuel est incorrect. "
                    ])
                    ],
                    'required'=>false,
            ])
            ->add('plainPassword', RepeatedType::class,[
                'required'=>false,
                'type' => PasswordType::class,
                'first_options'=>[
                    'constraints'=>[
                        new NotBlank([
                            'message'=>'Le nouveau mot de passe est obligatoire.'
                        ]),
                        new Length([
                            'min'=>12,
                            'max'=>255,
                            'minMessage'=>'Le nouveau mot de passe doit contenir au minimun {{limit}} caractères',
                            'maxMessage'=>'Le nouveau mot de passe doit contenir au maximum {{limit}} caractères'
                        ]),
                        new Regex([
                            'pattern'=>'/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{14,}$/',
                            'match'=>true,
                            'message'=>"Le mot de passe doit contenir 14 caractères avec 1 majuscule, 1 minuscule, 1 chiffre, 1 caractère spécial. "
                    ])
                    ], 
                ],
                'invalid_message' => 'Les mots de passe ne sont pas identiques.',
                //'attr' => ['autocomplete' => 'new-password'],
        ])
    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
