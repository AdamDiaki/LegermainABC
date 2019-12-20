<?php


namespace App\Controller;

use App\Entity\RequestProject;
use App\Entity\User;
use App\Form\RequestForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;

class RequestController extends AbstractController
{
    /**
     * @Route("/demande", name="requestCont")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function new(Request $request)
    {
       $user = new User();
       $userDetail = new RequestProject();

       $form = $this->createForm(RequestForm::class, ['user' =>$user, 'userDetail' => $userDetail]);

       $form->handleRequest($request);

       return $this->render('form/requestForm.html.twig', [
           'requestForm' => $form->createView()
       ]);
    }

}