<?php

declare(strict_types=1);

namespace Src\FileSearcher\Filters;


class MimeTypeFilter implements Filter
{
    /**
     * @var string
     */
    private string $mimeType;

    public function __construct(string $mimeType)
    {
        if ($mimeType === '') {
            throw new \InvalidArgumentException('Invalid regular expression');
        }
        $this->mimeType = $mimeType;
    }

    /**
     * @param string $file
     *
     * @return bool
     */
    public function filter(string $file): bool
    {
        return mime_content_type($file) === $this->mimeType;
    }
}