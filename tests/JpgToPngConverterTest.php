<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Src\FileSearcher\Converters\JpgToPngConverter;
use Src\ImageHelper\ImageHelper;

class JpgToPngConverterTest extends TestCase
{
    public function testWrongFolder()
    {
        $imageHelper = $this->createMock(ImageHelper::class);
        $this->expectException(\InvalidArgumentException::class);
        $converter = new JpgToPngConverter('/unknown-folder/', $imageHelper);
    }

    public function testWrongFile()
    {
        $imageHelper = $this->createMock(ImageHelper::class);
        $this->expectException(\InvalidArgumentException::class);
        $converter = new JpgToPngConverter(__DIR__, $imageHelper);
        $converter->convert(__FILE__);
    }

    public function testConvertFile()
    {
        $destinationFolder = __DIR__ . '/tmp';
        $imageHelper = $this->createMock(ImageHelper::class);

        if (!is_dir($destinationFolder)) {
            mkdir($destinationFolder);
        }
        $converter = new JpgToPngConverter($destinationFolder, $imageHelper);
        $image = $converter->convert(__DIR__ . '/images/image1.jpg', '/1');
        $this->assertTrue(realpath($image) == realpath($destinationFolder . '/1/image1.png'));

        if (is_dir($destinationFolder . '/1')) {
            rmdir($destinationFolder . '/1');
        }
        rmdir($destinationFolder);
    }
}
