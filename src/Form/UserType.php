<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {   
            if($options['email']){
                $builder
                ->add('email')
                ->add('roles')
                //->add('password')
                ;
        }
            if($options['roles']){
            $builder
                ->add('roles', ChoiceType::class,[
                    'choices'=>[
                        'Utilisateur'=>'ROLE_USER',
                        'Administrateur'=>'ROLE_ADMIN'
                    ],
                    'multiple'=>true,
                    'expanded'=>true,
                    ])
                ;
                }
                if($options['password']){
                $builder
                    ->add('password')
                ;
                }
                if($options['nomUser']){
                $builder
                    ->add('nomUser')
                    ;
            }   
            if($options['prenomUser']){
                $builder
                    ->add('prenomUser')
                    ;
            }
            if($options['admin']){
                $builder
                    ->add('admin', CheckboxType::class,[
                        'mapped'=>false,
                        'label'=>'Administrateur?',
                        'required'=>false,
                        'data'=>$options['checkbox']//data est la checkbox
                    ])
                    ;
            }
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'email'=>false,
            'roles'=>false,
            'password'=>false,
            'nomUser'=>false,
            'prenomUser'=>false,
            'admin'=>false,
            'checkbox'=>null
        ]);
    }
}
