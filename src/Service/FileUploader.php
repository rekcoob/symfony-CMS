<?php

namespace App\Service;

use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    /**
     * @var ContainerInterface
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function uploadFile(UploadedFile $file)
    {
        // Generate Unique Filename For Image
        $filename = md5(uniqid()) . '.' . $file->guessClientExtension();

        // Upload File To Specific Directory Defined In Services.yaml
        $file->move(
            $this->container->getParameter('uploads_dir'),
            $filename
        );

        return $filename;
    }
}