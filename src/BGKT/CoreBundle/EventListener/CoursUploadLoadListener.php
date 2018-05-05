<?php
/**
 * Created by PhpStorm.
 * User: toque
 * Date: 05/05/2018
 * Time: 18:56
 */

namespace BGKT\CoreBundle\EventListener;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use BGKT\CoreBundle\Entity\Cours;
use BGKT\CoreBundle\Service\FileUploader;

class CoursUploadLoadListener
{
    private $uploader;

    public function __construct(FileUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    private function uploadFile($entity)
    {
        // upload only works for Product entities
        if (!$entity instanceof Cours) {
            return;
        }

        $file = $entity->getDocument();

        // only upload new files
        if ($file instanceof UploadedFile) {
            $fileName = $this->uploader->upload($file);
            $entity->setDocument($fileName);
        }
    }
}