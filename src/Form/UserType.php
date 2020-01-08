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
                'label' => 'Nom',
                //'attr' => array('style' => 'width: 500px')
            ))
            ->add('firstname', null, array(
                'label' => 'Prénom',
                //'attr' => array('style' => 'width: 500px')
            ))
            ->add('email', null, array(
                'label' => 'Email',
                //'attr' => array('style' => 'width: 500px')
            ))
            ->add('number', null, array(
                'label' => 'Numéro de téléphone',
                //'attr' => array('style' => 'width: 500px')
            ))
            ->add('address', null, array(
                'label' => 'Adresse postale',
                //'attr' => array('style' => 'width: 500px')
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