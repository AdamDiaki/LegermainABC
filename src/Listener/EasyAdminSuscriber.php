<?php
namespace App\Listener;

use App\Entity\RequestProject;
use EasyCorp\Bundle\EasyAdminBundle\Event\EasyAdminEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;


class EasyAdminSuscriber implements EventSubscriberInterface
{

    private $mailer;

    /**
     * EasyAdminSuscriber constructor.
     */
    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }




    public static function getSubscribedEvents()
    {
        return array(
          EasyAdminEvents::POST_SHOW => array('preEdit'),
        );
    }

    public function preEdit(GenericEvent $event){
        $entity = $event->getSubject();


        if (!($entity instanceof  RequestProject)){
            return;
        }

        $message = (new \Swift_Message("Votre de demande de devis a été lu par l'artisan"))
            ->setFrom('legermainabc@gmail.com')
            ->setTo($entity->getUser()->getEmail())
            ->setBody("Bonjour M/Mme ". $entity->getUser()->getName()." ". $entity->getUser()->getFirstname().".". " L'artisan est  entrain d'examiné votre demande devis. Merci de votre confiance !"
            )
        ;
        $this->mailer->send($message);




    }


}
