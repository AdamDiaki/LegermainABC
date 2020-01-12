<?php

namespace App\Form;



use App\Entity\User;
use Captcha\Bundle\CaptchaBundle\Form\Type\CaptchaType;
use Captcha\Bundle\CaptchaBundle\Validator\Constraints\ValidCaptcha;
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
            ])
            ->add('resumeFile', FileType::class,[
                'label' => 'Lettre de motivation',
                'mapped' => false
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
