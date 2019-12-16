<?php

namespace App\Form;

use App\Entity\Applicant;
use App\Entity\Application;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OfferFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname',null, array(
                'label' => 'Prénom',
                'attr' => array('style' => 'width: 400px')
            ))
            ->add('name',null, array(
                'label' => 'Nom',
                'attr' => array('style' => 'width: 400px')
            ))
            ->add('email',null, array(
                'label' => 'Email',
                'attr' => array('style' => 'width: 400px')
            ))
            ->add('number',null, array(
                'label' => 'Numero',
                'attr' => array('style' => 'width: 400px')
            ))
            ->add('address',null, array(
                'label' => 'Addresse',
                'attr' => array('style' => 'width: 400px')
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' =>
                User::class
        ]);
    }
}
