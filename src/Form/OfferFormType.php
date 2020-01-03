<?php

namespace App\Form;



use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

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
            ->add('cvFile', FileType::class,[
                'label' => 'CV',
                'mapped' => false
            /*
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => "Veuillez joindre une lettre de motivation sous format pdf",
                    ])
                ],
            */
            ])
            ->add('resumeFile', FileType::class,[
                'label' => 'Lettre de motivation',
                'mapped' => false
                /*
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'application/pdf',
                         ],
                        'mimeTypesMessage' => "Veuillez joindre un cv sous format pdf",
                    ])
            ],
                */
            ])
            ->add('offerId', null,[
                'label' => false,
                'mapped' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' =>
                User::class,
            'validation_groups' => false,
        ]);
    }
}
