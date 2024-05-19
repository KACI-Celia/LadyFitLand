<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom', TextType::class,[
                'label'=>'Nom',
                'required'=>false,
                'constraints'=>[
                    new NotBlank([
                        'message'=>'Veuillez renseigner votre nom'
                    ])
                ]
            ])
            ->add('Prenom', TextType::class,[
                'label'=>'Prénom',
                'required'=>false,
                'constraints'=>[
                    new NotBlank([
                        'message'=>'Veuillez renseigner votre prénom'
                    ])
                ]
            ])
            ->add('email', EmailType::class,[
                'required'=>false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer votre Email',
                    ]),
                ],
            ])
            ->add('sujet', TextType::class,[
                'required'=>false,
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '100',
                ],
                'label' => 'Sujet',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer votre sujet',
                    ]),
                ],
            ])

            ->add('message', TextareaType::class, [
                'required'=>false,
                
                'label' => 'Description',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer votre message',
                    ]),
                ],
            ])
            ->add('submit', SubmitType::class,[
                'attr'=>[
                    'class'=>'btn btn-primary mt-4'
                ],
                'label'=>'Envoyer votre demande'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
