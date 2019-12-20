<?php


namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RequestForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $option)
    {
        $builder
            ->add('user',UserType::class, [
                'label' =>false
            ])
            ->add('userDetail', RequestType::class, [
                'label' => false
            ])
        ;
    }
}