<?php
namespace App\Listener;

use App\Entity\RequestProject;
use Doctrine\Common\Persistence\ObjectManager;
use EasyCorp\Bundle\EasyAdminBundle\Event\EasyAdminEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;


/**
 * Class EasyAdminSuscriber
 * @package App\Listener
 */
class EasyAdminSuscriber implements EventSubscriberInterface
{

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * EasyAdminSuscriber constructor.
     */
    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }


    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
          EasyAdminEvents::POST_SHOW => array('preEdit'), EasyAdminEvents::PRE_UPDATE => array('preUpdate')
        );
    }


    /**
     * Permet d'envoyer un message au client quand l'arisan consulte sa demande
     * @param GenericEvent $event
     */
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

    /**
     * Permet d'envoyer un message au client quand l'arisan consulte sa demande  
     * @param GenericEvent $event
     */
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
