<?php

declare(strict_types=1);

require_once '../bootstrap.php';

use Src\FileSearcher\BaseFileSearcher;
use Src\FileSearcher\Converters\JpgToPngConverter;
use Src\FileSearcher\Filters\MimeTypeFilter;
use Src\FileSearcher\Filters\NameFilter;
use Src\ImageHelper\ImagickImageHelper;

$searcher = new BaseFileSearcher();

$searcher->addFilter(new MimeTypeFilter('image/jpeg'));
$searcher->addFilter(new NameFilter('~^image[13]?$~'));
$searcher->addConverter(new JpgToPngConverter('../storage/tmp', new ImagickImageHelper()));

echo implode('<br>', $searcher->getFiles('../storage/images/'));