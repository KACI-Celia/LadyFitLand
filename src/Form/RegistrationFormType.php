<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Form\FormBuilderInterface;
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
use Symfony\Component\Validator\Constraints\Regex;

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

            //->add('dateNaissanceUser', BirthdayType::class,[
                //'label'=>'Date de naissance',
                //'row_attr'=>[
                  //  'class'=>'shadow p-3 bg-white'
                //],
                //'widget'=>'single_text',
            //     'format'=>'dd-MM-yyyy',
            //     'html5' => false, // cette phrase permet d'eviter l'erreur par rapport au format de la date
            //])

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

            ->add('telUser', IntegerType::class,[
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
                        'max'=>10,
                        'minMessage'=>'Le numéro de téléphone doit contenir 10 chiffres',
                        'maxMessage'=>'Le numéro de téléphone ne doit pas dépasser 10 chiffres'
                    ])
                ]
            ])

            ->add('email', EmailType::class,[
                'label'=>'Email',
                'row_attr'=>[
                    'class'=>'shadow p-3'
                ],
                'required'=>false,
                'constraints'=>[
                    new NotBlank([
                        'message'=>'Veuillez renseigner votre adresse mail'
                    ])
                ]
            ])
            
            ->add('dateNaissanceUser', DateType::class, [
                'label'=>'Date de naissance',
                'widget' => 'choice',
                'input'  => 'datetime_immutable',
                'years'=>range(date('Y')-100,date('Y')),
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

            ->add('plainPassword', PasswordType::class, [
                                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'row_attr'=>[
                    'class'=>'shadow p-3'
                ],
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new Regex('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{14,}$/',
                    "Le mot de passe doit contenir 14 caractères avec 1 majuscule, 1 minuscule, 1 chiffre, 1 caractère spécial")
                ],
            ])

            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label'=>'Accepter les conditions',
                'row_attr'=>[
                    'class'=>'shadow p-3 m-0'
                ],
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez acceptez les conditions.',
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
}//ça correspond à quoi ça?
