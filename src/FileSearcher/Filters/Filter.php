<?php


namespace Src\FileSearcher\Filters;


interface Filter
{

    /**
     * @param string $file
     *
     * @return bool
     */
    public function filter(string $file): bool;
}