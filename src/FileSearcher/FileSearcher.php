<?php


namespace Src\FileSearcher;

use Generator;

interface FileSearcher
{
    /**
     * @param Filters\Filter $filter
     */
    public function addFilter(Filters\Filter $filter): void;

    /**
     * @param Converters\Converter $converter
     */
    public function addConverter(Converters\Converter $converter): void;

    /**
     * @param string $folder
     *
     * @return array
     */
    public function getFiles(string $folder): array;

    /**
     * @param string $folder
     *
     * @return Generator
     */
    public function getFilesLazy(string $folder): Generator;
}