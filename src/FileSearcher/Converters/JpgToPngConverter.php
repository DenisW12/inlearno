<?php

declare(strict_types=1);

namespace Src\FileSearcher\Converters;

use Src\ImageHelper\ImageHelper;

class JpgToPngConverter implements Converter
{
    /**
     * @var string
     */
    private string $destinationFolder;

    /**
     * @var ImageHelper
     */
    private ImageHelper $imageHelper;

    /**
     * JpgToPngConverter constructor.
     *
     * @param string      $destinationFolder
     * @param ImageHelper $imageHelper
     */
    public function __construct(string $destinationFolder, ImageHelper $imageHelper)
    {
        if (!is_writable($destinationFolder)) {
            throw new \InvalidArgumentException('Wrong destination folder');
        }
        $this->destinationFolder = realpath($destinationFolder);
        $this->imageHelper = $imageHelper;
    }

    /**
     * @param string $file
     * @param string $subFolder
     *
     * @return string
     */
    public function convert(string $file, string $subFolder = ''): string
    {
        if (mime_content_type($file) !== 'image/jpeg') {
            throw new \InvalidArgumentException('Invalid file format');
        }

        $newFileName = preg_replace('~\.[A-Za-z]+$~', '.png', basename($file));
        $newPath = $this->destinationFolder . $subFolder . '/' . $newFileName;

        if (!is_dir(dirname($newPath))) {
            mkdir(dirname($newPath), 0777, true);
        }

        $this->imageHelper->jpgToPng($file, $newPath);

        return $newPath;
    }
}