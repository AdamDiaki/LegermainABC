<?php

namespace App\Controller;

use App\Entity\Application;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MailerController extends AbstractController
{
    /**
     * @Route("/mailer", name="mailer")
     */
    public function sendMailToCustomer(Application $application, \Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message( 'Hello Email' ))
            ->setFrom( 'legermainabc@gmail.com' )
            ->setTo( $application->getUser()->getEmail() )
            ->setBody(
                $this->renderView(
                    'mailer/mailer.html.twig',
                    ['user' => $application->getUser()]
                ),
                'text/plain'

            );


        $mailer->send( $message );
        return $this->render( 'mailer/mailer.html.twig', [
            'controller_name' => 'MailerController',
        ] );
    }
}
