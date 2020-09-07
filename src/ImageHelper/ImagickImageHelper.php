<?php


namespace Src\ImageHelper;

use Imagick;
use ImagickException;

class ImagickImageHelper implements ImageHelper
{

    /**
     * @param string $file
     * @param string $toFile
     */
    public function jpgToPng(string $file, string $toFile): void
    {
        try {
            $im = new Imagick($file);
            $im->setImageFormat('png');
            $im->writeImage($toFile);
        } catch (ImagickException $e) {
            throw new ImageHelperException($e->getMessage());
        }
    }
}