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
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenomUser', TextType::class,[
                'label'=>'Prénom'
            ])
            ->add('nomUser', TextType::class,[
                'label'=>'Nom'
            ])

            ->add('dateNaissanceUser', BirthdayType::class,[
                'label'=>'Date de naissance',
                'widget'=>'single_text',
                'format'=>'dd-MM-yyyy',
                'html5' => false, // cette phrase permet d'eviter l'erreur par rapport au format de la date
            ])

            ->add('adresseUser', TextType::class,[
                'label'=>'Adresse'
            ])

            ->add('telUser', IntegerType::class,[
                'label'=>'Numéro de téléphone'
            ])

            ->add('email', EmailType::class,[
                'label'=>'Email'
            ])
            ->add('conirmationEmail', RepeatedType::class,[
                'type'=>EmailType::class,
                'first_options'=>['label'=>'Confirmation Email']
            ])

            
            ->add('plainPassword', PasswordType::class, [
                                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Rentrez votre mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])

            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
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
