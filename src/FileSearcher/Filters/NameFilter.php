<?php

declare(strict_types=1);

namespace Src\FileSearcher\Filters;


class NameFilter implements Filter
{
    /**
     * @var string
     */
    private string $pattern;

    /**
     * NameFilter constructor.
     *
     * @param string $pattern
     */
    public function __construct(string $pattern)
    {
        if ($pattern === '') {
            throw new \InvalidArgumentException('Invalid regular expression');
        }

        $this->pattern = $pattern;
    }

    /**
     * @param string $file
     *
     * @return bool
     */
    public function filter(string $file): bool
    {
        $fileName = preg_replace('~\.[A-Za-z]+$~', '', basename($file));

        try {
            $result = preg_match($this->pattern, $fileName);
        } catch (\Throwable $e) {
            throw new \InvalidArgumentException('Invalid regular expression');
        }

        return (bool)$result;
    }
}