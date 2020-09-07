<?php

use PHPUnit\Framework\TestCase;
use Src\FileSearcher\Filters\MimeTypeFilter;

class MimeTypeFilterTest extends TestCase
{
    public function testEmptyMimeType()
    {
        $this->expectException(\InvalidArgumentException::class);
        $filter = new MimeTypeFilter('');
    }

    public function testMimeTypeFilter()
    {
        $filter = new MimeTypeFilter('image/jpeg');
        $this->assertTrue($filter->filter(__DIR__ . '/images/image1.jpg'));
    }
}
