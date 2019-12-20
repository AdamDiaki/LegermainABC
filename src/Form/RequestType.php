<?php


namespace App\Form;


use App\Entity\RequestProject;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, array(
                'label' => 'Objet de la demande'
                ))
            ->add('category', null, array(
                'label' => 'Catégories',
                'attr' => array('style' => 'width: 500px')
            ))
            ->add('content', null, array(
                'label' => 'Description'
            ))

            //->add('submit', SubmitType::class, ['label' => 'Create Task'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RequestProject::class
        ]);
    }
}