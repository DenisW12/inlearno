<?php

declare(strict_types=1);

require_once '../bootstrap.php';

use Src\FileSearcher\BaseFileSearcher;
use Src\FileSearcher\Filters\MimeTypeFilter;
use Src\FileSearcher\Filters\NameFilter;

$searcher = new BaseFileSearcher();

$searcher->addFilter(new MimeTypeFilter('image/jpeg'));
$searcher->addFilter(new NameFilter('~^image[13]?$~'));

echo implode('<br>', $searcher->getFiles('../storage/images/'));