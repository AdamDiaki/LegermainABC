<?php


namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class RequestForm
 * @package App\Form
 */
class RequestForm extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $option
     */
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