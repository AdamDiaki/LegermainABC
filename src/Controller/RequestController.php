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
     * @param \Swift_Mailer $mailer
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request, \Swift_Mailer $mailer)
    {
        $user = new User();
        $userDetail = new RequestProject();

        $form = $this->createForm(RequestForm::class, ['user' => $user, 'userDetail' => $userDetail]);

        $userDetail->setCreatedAt(new \DateTime());
        $userDetail->setUser($user);
        $userDetail->setSaw(0);

        if ('POST' === $request->getMethod()) {

            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $em->persist($user);
                $em->flush();

                $em->persist($userDetail);
                $em->flush();

                $message = (new \Swift_Message("Nouvelle demande de devis"))
                    ->setFrom('legermainabc@gmail.com')
                    ->setTo('legermainabc@gmail.com')
                    ->setBody("Vous avez reçu une nouvelle demande. ");

                $mailer->send($message);
                return $this->render('mailer/mailerArt.html.twig', [
                    'controller_name' => 'MailerArtisanController', 'name' => $user->getName(), 'firstname' => $user->getFirstname()
                ]);
            }
        }
        return $this->render('form/requestForm.html.twig', [
            'requestForm' => $form->createView()
        ]);
    }
}