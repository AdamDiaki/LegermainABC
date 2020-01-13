<?php

namespace App\Listener;

use App\Entity\ArticleImages;
use App\Entity\Image;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

/**
 * Class ImageCacheSubscriber
 * @package App\Listener
 */
class ImageCacheSubscriber implements EventSubscriber
{
    /**
     * @var CacheManager
     */
   private $cacheManager;
    /**
     * @var UploaderHelper
     */
   private $uploaderHelper;

    /**
     * ImageCacheSubscriber constructor.
     * @param CacheManager $cacheManager
     * @param UploaderHelper $uploaderHelper
     */
    public function __construct(CacheManager $cacheManager, UploaderHelper $uploaderHelper)
    {
        $this->cacheManager = $cacheManager;
        $this->uploaderHelper = $uploaderHelper;
    }

    /**
     * Permet de supprimer les images en caches quand on supprime l'image
     * @param LifecycleEventArgs $args
     */
    public function preRemove(LifecycleEventArgs $args){
        $entity = $args->getEntity();
        if(!$entity instanceof Image){
            return;
        }

        $this->cacheManager->remove($this->uploaderHelper->asset($entity, 'imageFile'));



    }

    /** Permet de mettre à jour les images en cache quand on met à jour l'image
     * @param PreUpdateEventArgs $args
     */
    public function preUpdate(PreUpdateEventArgs $args){
        $entity = $args->getEntity();
        if(!$entity instanceof Image){
            return;
        }
        if($entity->getImageFile() instanceof  UploadedFile){
           $this->cacheManager->remove($this->uploaderHelper->asset($entity, 'imageFile'));
        }




    }


    /**
     * @inheritDoc
     */
    public function getSubscribedEvents()
    {
        return ['preRemove',
            'preUpdate'];
    }

    /**
     * @return CacheManager
     */
    public function getCacheManager(): CacheManager
    {
        return $this->cacheManager;
    }

    /**
     * @param CacheManager $cacheManager
     */
    public function setCacheManager(CacheManager $cacheManager): void
    {
        $this->cacheManager = $cacheManager;
    }

    /**
     * @return UploaderHelper
     */
    public function getUploaderHelper(): UploaderHelper
    {
        return $this->uploaderHelper;
    }

    /**
     * @param UploaderHelper $uploaderHelper
     */
    public function setUploaderHelper(UploaderHelper $uploaderHelper): void
    {
        $this->uploaderHelper = $uploaderHelper;
    }


}





