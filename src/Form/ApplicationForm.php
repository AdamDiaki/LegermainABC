<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class ApplicationForm
 * @package App\Form
 */
class ApplicationForm extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
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