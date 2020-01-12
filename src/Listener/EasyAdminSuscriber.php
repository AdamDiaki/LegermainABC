<?php
namespace App\Listener;

use App\Entity\RequestProject;
use Doctrine\Common\Persistence\ObjectManager;
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
          EasyAdminEvents::POST_SHOW => array('preEdit'), EasyAdminEvents::PRE_UPDATE => array('preUpdate'),EasyAdminEvents::PRE_PERSIST =>array('prePersit')
        );
    }


    public function preEdit(GenericEvent $event ){
        $entity = $event->getSubject();


        if (!($entity instanceof  RequestProject)){
            return;
        }
        elseif ($entity->getSaw() == true){
            return ;
        }

        $message = (new \Swift_Message("Votre de demande de devis a été lu par l'artisan"))
            ->setFrom('legermainabc@gmail.com')
            ->setTo($entity->getUser()->getEmail())
            ->setBody("Bonjour M/Mme ". $entity->getUser()->getName()." ". $entity->getUser()->getFirstname().".". " L'artisan est  entrain d'examiné votre demande devis. Merci de votre confiance !"
            )
        ;
        $this->mailer->send($message);
        $entity->setSaw(true);
    }

    public function preUpdate(GenericEvent $event){
        $entity = $event->getSubject();


        if (!($entity instanceof  RequestProject)){
            return;
        }
        elseif ($entity->getSaw() == 1){
            return ;
        }

        $message = (new \Swift_Message("Votre de demande de devis a été lu par l'artisan"))
            ->setFrom('legermainabc@gmail.com')
            ->setTo($entity->getUser()->getEmail())
            ->setBody("Bonjour M/Mme ". $entity->getUser()->getName()." ". $entity->getUser()->getFirstname().".". " L'artisan est  entrain d'examiné votre demande devis. Merci de votre confiance !"
            )
        ;
        $this->mailer->send($message);
        $entity->setSaw(true);




    }


}
