<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'label' => 'Nom'
            ))
            ->add('firstname', null, array(
                'label' => 'Prénom'
            ))
            ->add('email', null, array(
                'label' => 'Email'
            ))
            ->add('number', null, array(
                'label' => 'Numéro de téléphone'
            ))
            ->add('address', null, array(
                'label' => 'Adresse postale'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }
}