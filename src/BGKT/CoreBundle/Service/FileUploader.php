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


class FileUploader
{
    private $coursDir;

    public function __construct($coursDir)
    {
        $this->coursDir = $coursDir;
    }

    public function upload($class)
    {
        if ($class instanceof Cours) {
            $file = $class->getDocument();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->coursDir, $fileName);
            $class->setDocument($fileName);
        }

        return $class;
    }
}