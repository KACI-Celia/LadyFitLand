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
                'row_attr'=>[
                    'class'=>'shadow p-3' 
                ],
                'required'=>false,
                'constraints'=>[
                    
                    new NotBlank([
                        'message'=>'Veuillez renseigner votre prénom'
                    ])
                ]
            ])
            ->add('nomUser', TextType::class,[
                'label'=>'Nom',
                'row_attr'=>[
                    'class'=>'shadow p-3'
                ],
                'required'=>false,
                'constraints'=>[
                    new NotBlank([
                        'message'=>'Veuillez renseigner votre nom'
                    ])
                ]
                ])

            ->add('adresseUser', TextType::class,[
                'label'=>'Adresse',
                'row_attr'=>[
                    'class'=>'shadow p-3'
                ],
                'required'=>false,
                'constraints'=>[
                    new NotBlank([
                        'message'=>'Veuillez renseigner votre adresse'
                    ])
                ]
            ])
            ->add('zipcode',TextType::class,[
                'label'=>'Code postal',
                'row_attr'=>[
                    'class'=>'shadow p-3'
                ],
            ])

            ->add('city',TextType::class,[
                'label'=>'Ville',
                'row_attr'=>[
                    'class'=>'shadow p-3'
                ],
            ])
            ->add('telUser', TextType::class,[
                'label'=>'Numéro de téléphone',
                'row_attr'=>[
                    'class'=>'shadow p-3'
                ],
                'required'=>false,
                'constraints'=>[
                    new NotBlank([
                        'message'=>'Veuillez renseigner votre numéro de téléphone'
                    ]),
                    new Length([
                        'min'=>10,
                        //'max'=>10,
                        'minMessage'=>'Le numéro de téléphone doit contenir 10 chiffres',
                        'maxMessage'=>'Le numéro de téléphone ne doit pas dépasser 10 chiffres'
                    ])
                ]
            ])

            ->add('email', EmailType::class,[
                'label'=>'E-mail',
                'row_attr'=>[
                    'class'=>'shadow p-3'
                ],
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
                'row_attr'=>[
                    'class'=>'shadow p-3 m-0'
                ],
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
                'row_attr'=>[
                    'class'=>'shadow p-3 ms-2',
                    
                ],
                'mapped' => false,
                'first_options'=>[
                    'label'=>'Mot de passe'
                ],
                
                'second_options'=>[
                    'label'=>'Confirmez le mot de passe'
                ],

                'invalid_message' => 'Les mots de passe ne correspondent pas.',
                'attr' => ['autocomplete' => 'new-password'],
                // 'constraints' => [
                //     new Regex([
                //         'pattern'=>'/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{14,}$/',
                //         'message'=>"Le mot de passe doit contenir 14 caractères avec 1 majuscule, 1 minuscule, 1 chiffre, 1 caractère spécial. "
                    
                //     ]),
                // ],
            ])

            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,//permet de dire que cette propriete n'existe pas dans la bdd(elle n'est pas associée à une proprièté user de ce formulaire)
                'label'=>'j\'accepte les conditions',
                'row_attr'=>[
                    'class'=>'shadow p-3 m-0'
                ],
                'constraints' => [
                    new IsTrue([
                        'message' => 'Veuillez accepter les conditions générales d\'utilisations.',
                    ]),
                ],
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