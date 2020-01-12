<?php


namespace App\Controller;

use App\Entity\RequestProject;
use App\Entity\User;
use App\Form\RequestForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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

        $form = $this->createForm( RequestForm::class, ['user' => $user, 'userDetail' => $userDetail] );

        $form->handleRequest( $request );

        return $this->render( 'form/requestForm.html.twig', [
            'requestForm' => $form->createView()
        ] );
    }

}