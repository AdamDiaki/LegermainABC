<?php


namespace App\Controller;

use App\Entity\RequestProject;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;

class RequestController extends AbstractController
{
    /**
     * @Route("/Request", name="requestCont")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        $User = new User();
        $RequestProject = new RequestProject();

        //$form = $this->get('form.factory')->createBuilder(FormType::class, $RequestProject)

        $form = $this->createFormBuilder($RequestProject)

            ->add('name', TextType::class)
            ->add('firstname', TextType::class)
            ->add('email', TextType::class)
            ->add('Demande', TextType::class) //title
            ->add('content', TextType::class) //content
            ->add('category', TextType::class)
            ->add('submit', SubmitType::class, ['label' => 'Create Task'])
            ->getForm();


        return $this->render('/form/requestForm.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}