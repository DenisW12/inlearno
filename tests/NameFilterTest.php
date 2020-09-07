<?php

use PHPUnit\Framework\TestCase;
use Src\FileSearcher\Filters\NameFilter;

class NameFilterTest extends TestCase
{
    public function testEmptyPattern()
    {
        $this->expectException(\InvalidArgumentException::class);
        $filter = new NameFilter('');
    }

    public function testWrongPattern()
    {
        $this->expectException(\InvalidArgumentException::class);
        $filter = new NameFilter('~^image[0-9]?$');
        $this->assertTrue($filter->filter(__DIR__ . '/images/image1.jpg'));
    }

    public function testNameFilter()
    {
        $filter = new NameFilter('~^image[0-9]?$~');
        $this->assertTrue($filter->filter(__DIR__ . '/images/image1.jpg'));
    }
}
