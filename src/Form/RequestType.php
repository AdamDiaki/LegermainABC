<?php


namespace App\Form;


use App\Entity\Category;
use App\Entity\RequestProject;

use Symfony\Component\Form\AbstractType;


use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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

            /*->add('category', ChoiceType::class, array(
                'choices' => array(
                    'Charpente' => $cat = new Category(),
                    'Couverture' => 2,
                    'Ouvrages spcifiques'=> 3
                ),
                'label' => 'Catégories'
            ))*/

            ->add('category', null, array(
                'label' => 'Catégories',
                'attr' => array('','style' => 'width: 500px')
            ))

            ->add('content', null, array(
                'label' => 'Description'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RequestProject::class
        ]);
    }
}