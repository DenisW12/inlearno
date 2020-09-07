<?php

namespace Src\ImageHelper;

interface ImageHelper
{
    /**
     * @param string $file
     * @param string $toFile
     */
    public function jpgToPng(string $file, string $toFile): void;
}