<?php


namespace App\Controller;

use App\Entity\RequestProject;
use App\Entity\User;
use App\Form\RequestForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

        $userDetail->setCreatedAt(new \DateTime());
        $userDetail->setUser($user);
        $userDetail->setSaw(0);

        if ('POST' === $request->getMethod()) {

            $form->handleRequest( $request );

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $em->persist($user);
                $em->flush();

                $em->persist($userDetail);
                $em->flush();

                return $this->redirectToRoute('mailer');
            }
        }


        return $this->render( 'form/requestForm.html.twig', [
            'requestForm' => $form->createView()
        ] );
    }

}