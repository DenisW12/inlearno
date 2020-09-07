<?php

declare(strict_types=1);

require_once '../bootstrap.php';

use Src\FileSearcher\BaseFileSearcher;
use Src\FileSearcher\Filters\MimeTypeFilter;

$searcher = new BaseFileSearcher();

$searcher->addFilter(new MimeTypeFilter('image/jpeg'));

echo implode('<br>', $searcher->getFiles('../storage/images/'));