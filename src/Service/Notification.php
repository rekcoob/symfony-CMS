<?php

namespace App\Service;

use App\Service\FileUploader;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Notification
{
    public function __construct( $email, FileUploader $fileUploader)
    {
        // dump($fileUploader); die;
        $this->email = $email;        
    }

    public function sendNotification()
    {

    }
}