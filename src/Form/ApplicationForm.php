<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ApplicationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user',OfferFormType::class,array(
                'label' => false
            ))
            ->add('application', ApplicationType::class,array(
                'label' => false
            ));
    }

}