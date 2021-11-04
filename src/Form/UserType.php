<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
                $roles=array(
                    "ROLE_SUPERADMIN"=>"Role SuperAdmin",
                "ROLE_ADMIN"=>"Role Admin",
                "ROLE_DIRECTOR"=>"Role Director"
            );
            $gender=array("Male"=>"Male","Female"=>"Female");

        $builder
            
            ->add('roles',ChoiceType::class,[
                "choices"=>$roles,
                "mapped"=>false
            ])
           
            ->add('firstName')
            ->add('middleName')
            ->add('lastName')
            ->add('email')
            ->add('phone')
             
            ->add('gender',ChoiceType::class,[
                "choices"=>$gender
            ])
           
            ->add('office')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
