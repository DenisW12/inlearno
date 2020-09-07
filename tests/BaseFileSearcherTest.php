<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Src\FileSearcher\BaseFileSearcher;
use Src\FileSearcher\Converters\Converter;
use Src\FileSearcher\Exceptions\FolderNotFoundException;
use Src\FileSearcher\Filters\Filter;

class BaseFileSearcherTest extends TestCase
{
    public function testFolderNotFound()
    {
        $searcher = new BaseFileSearcher();
        $this->expectException(FolderNotFoundException::class);
        $searcher->getFiles('/unknown-folder/');
    }

    public function testSearchFiles()
    {
        $searcher = new BaseFileSearcher();
        $this->assertCount(2, $searcher->getFiles(static::imagesFolder()));
    }

    public function testLazySearchFiles()
    {
        $searcher = new BaseFileSearcher();
        $files = [];
        foreach ($searcher->getFilesLazy(static::imagesFolder()) as $file) {
            $files[] = $file;
        }
        $this->assertCount(2, $files);
    }

    public function testAddFilter()
    {
        $searcher = new BaseFileSearcher();
        $filter = $this->createMock(Filter::class);
        $searcher->addFilter($filter);
        $filter->method('filter')->willReturn(true);
        $this->assertCount(2, $searcher->getFiles(static::imagesFolder()));

        $searcher = new BaseFileSearcher();
        $filter = $this->createMock(Filter::class);
        $searcher->addFilter($filter);
        $filter->method('filter')->willReturn(false);
        $this->assertCount(0, $searcher->getFiles(static::imagesFolder()));
    }

    public function testAddConverter()
    {
        $searcher = new BaseFileSearcher();
        $filter = $this->createMock(Converter::class);
        $searcher->addConverter($filter);

        $this->assertCount(2, $searcher->getFiles(static::imagesFolder()));
    }

    protected static function imagesFolder()
    {
        return __DIR__ . '/images';
    }
}