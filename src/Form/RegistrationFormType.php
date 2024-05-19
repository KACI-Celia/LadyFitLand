<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenomUser', TextType::class,[
                'label'=>'Prénom',
                'required'=>false,
                'constraints'=>[
                    new NotBlank([
                        'message'=>'Veuillez renseigner votre prénom'
                    ])
                ]
            ])
            ->add('nomUser', TextType::class,[
                'label'=>'Nom',
                'required'=>false,
                'constraints'=>[
                    new NotBlank([
                        'message'=>'Veuillez renseigner votre nom'
                    ])
                ]
                ])

            ->add('adresseUser', TextType::class,[
                'label'=>'Adresse',
                'required'=>false,
                'constraints'=>[
                    new NotBlank([
                        'message'=>'Veuillez renseigner votre adresse'
                    ])
                ]
            ])
            ->add('zipcode',TextType::class,[
                'label'=>'Code postal',
                'required'=>false,
                
                'constraints'=>[
                    new NotBlank([
                        'message'=>'Veuillez renseigner le code postal'
                    ])
                ]
            ])

            ->add('city',TextType::class,[
                'label'=>'Ville',
                'required'=>false,
               
                'constraints'=>[
                    new NotBlank([
                        'message'=>'Veuillez renseigner la ville'
                    ])
                ]
            ])
            ->add('telUser', TextType::class,[
                'label'=>'Numéro de téléphone',
                
                'required'=>false,
                'constraints'=>[
                    new NotBlank([
                        'message'=>'Veuillez renseigner votre numéro de téléphone'
                    ]),
                    new Length([
                        'min'=>10,
                        'max'=>10,
                        'exactMessage'=>'Le numéro de téléphone doit contenir exactement {{ limit }} chiffres'
                    ]),
                    new Regex([
                        'pattern'=>'/^\d{10}$/',
                        'message'=>'Le numéro de téléphone doit contenir uniquement des chiffres'
                    ])
                ]
            ])

            ->add('email', EmailType::class,[
                'label'=>'E-mail',
                
                'required'=>false,
                'constraints'=>[
                    new NotBlank([
                        'message'=>'Veuillez renseigner votre adresse mail'
                    ]),
                    new Email([
                        'message'=>'The email "{{ value }}" is not a valid email.'// a verifier
                    ])
                ]
            ])
            
            ->add('dateNaissanceUser', DateType::class, [
                'label'=>'Date de naissance',
                'widget' => 'single_text',
                'input'  => 'datetime_immutable',
                'years'=>range(date('Y')-90,date('Y')),
                
                'required'=>false,
                'constraints'=>[
                    new NotBlank([
                        'message'=>'Veuillez renseigner votre date de naissance'
                    ])
                ]
            ])

            ->add('plainPassword', RepeatedType::class, [
                                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'type'=>PasswordType::class,
                
                'required'=>false,
                'mapped' => false,
                'first_options'=>[
                    'label'=>'Mot de passe'
                ],
                'constraints' => [
                    new NotBlank([
                        'message'=>'Le mot de passe est obligatoire.'
                    ]),
                    new Length([
                        'min'=>12,
                        'max'=>255,
                        'minMessage'=>'Le nouveau mot de passe doit contenir au minimun {{ limit }} caractères',
                        'maxMessage'=>'Le nouveau mot de passe doit contenir au maximum {{ limit }} caractères'
                    ]),
                    new Regex([
                        'pattern'=>'/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{12,}$/',
                        'message'=>"Le mot de passe doit contenir 12 caractères avec 1 majuscule, 1 minuscule, 1 chiffre, 1 caractère spécial. "
                    ]),
                ],
                'second_options'=>[
                    'label'=>'Confirmez le mot de passe',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez confirmer le mot de passe.'
                    ])
                ],

                'invalid_message' => 'Les mots de passe ne correspondent pas.',
                'attr' => ['autocomplete' => 'new-password'],
            ])

            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,//permet de dire que cette propriete n'existe pas dans la bdd(elle n'est pas associée à une proprièté user de ce formulaire)
                'label'=>'j\'accepte les conditions générales',
                
                'constraints' => [
                    new IsTrue([
                        'message' => 'Veuillez accepter les conditions générales d\'utilisations.',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            
        ]);
    }
}
