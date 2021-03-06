<?php

namespace App\Form;

use App\Entity\Application;
use phpDocumentor\Reflection\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ApplicationType
 * @package App\Form
 */
class ApplicationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('offer',null,array(
                'label' => false,
                'attr' => ['id' =>'offre']
            ))
            ->add('cvFile',FileType::class, array(
                'label' => 'CV',
                // 'attr' => array('style' => 'size: 1px'),
                'mapped' => false
            ))
            ->add('resumeFile',FileType::class, array(
                'label' => 'Lettre de motivation',
                //'attr' => array('style' => 'width: 200px')
            ))

        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Application::class,
        ]);
    }
}
