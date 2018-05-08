<?php
/**
 * Created by PhpStorm.
 * User: toque
 * Date: 05/05/2018
 * Time: 18:49
 */

namespace BGKT\CoreBundle\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use BGKT\CoreBundle\Entity\Cours;
use BGKT\CoreBundle\Entity\Devoir;


class FileUploader
{
    private $coursDir;
    private $devoirDir;

    public function __construct($coursDir, $devoirDir)
    {
        $this->coursDir = $coursDir;
        $this->devoirDir = $devoirDir;
    }

    public function upload($class)
    {
        if ($class instanceof Cours) {
            $file = $class->getDocument();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->coursDir, $fileName);
            $class->setDocument($fileName);
        }

        if($class instanceof Devoir){
            $file = $class->getDocument();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->devoirDir, $fileName);
            $class->setDocument($fileName);
        }

        return $class;
    }
}