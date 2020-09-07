<?php

declare(strict_types=1);

namespace Src\FileSearcher;

use Generator;
use Src\FileSearcher\Exceptions\FolderNotFoundException;

class BaseFileSearcher implements FileSearcher
{
    /**
     * @var array
     */
    private array $filters = [];

    /**
     * @var array
     */
    private array $converters = [];

    /**
     * @param Filters\Filter $filter
     */
    public function addFilter(Filters\Filter $filter): void
    {
        $this->filters[] = $filter;
    }

    /**
     * @param Converters\Converter $converter
     */
    public function addConverter(Converters\Converter $converter): void
    {
        $this->converters[] = $converter;
    }

    /**
     * @param string $folder
     *
     * @return array
     */
    public function getFiles(string $folder): array
    {
        $folder = $this->validateFolder($folder);

        $files = [];

        foreach ($this->getFilesLazyRecursive($folder) as $file) {
            $files[] = $file;
        }

        return $files;
    }

    /**
     * @param string $folder
     *
     * @return Generator
     */
    public function getFilesLazy(string $folder): Generator
    {
        $folder = $this->validateFolder($folder);

        yield from $this->getFilesLazyRecursive($folder);
    }

    /**
     * @param string $folder
     *
     * @return string
     */
    private function validateFolder(string $folder): string
    {
        if (!is_readable($folder)) {
            throw new FolderNotFoundException('Folder not found');
        }

        return realpath($folder);
    }


    /**
     * @param string $baseFolder
     * @param string $subFolder
     *
     * @return Generator
     */
    private function getFilesLazyRecursive(string $baseFolder, string $subFolder = ''): Generator
    {

        $folder = $baseFolder . $subFolder;

        $dh = opendir($folder);
        while (false !== ($file = readdir($dh))) {
            if (in_array($file, ['.', '..'])) {
                continue;
            }

            $filePath = $folder . '/' . $file;

            if (is_dir($filePath)) {
                yield from $this->getFilesLazyRecursive($baseFolder, $subFolder . '/' . $file);
                continue;
            }

            if (!$this->applyFilters($filePath)) {
                continue;
            }

            $file = $this->applyConverters($filePath, $subFolder);

            yield $file;
        }
    }

    /**
     * @param string $file
     *
     * @return bool
     */
    private function applyFilters(string $file): bool
    {
        foreach ($this->filters as $filter) {
            if (!$filter->filter($file)) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param string $file
     * @param string $subFolder
     *
     * @return string
     */
    private function applyConverters(string $file, string $subFolder): string
    {
        foreach ($this->converters as $converter) {
            $file = $converter->convert($file, $subFolder);
        }
        return $file;
    }
}