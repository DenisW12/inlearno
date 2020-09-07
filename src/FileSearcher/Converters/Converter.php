<?php


namespace Src\FileSearcher\Converters;


interface Converter
{
    /**
     * @param string $file
     * @param string $subFolder
     *
     * @return string
     */
    public function convert(string $file, string $subFolder): string;
}