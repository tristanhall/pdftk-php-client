<?php

namespace Tests\PdfSources;

use MinuteMan\PdftkClient\PdfSources\File;
use PHPUnit\Framework\TestCase;

/**
 * Class FileTest
 *
 * @package Tests\PdfSources
 */
class FileTest extends TestCase
{

    /**
     * Test for __construct() using the default arguments.
     */
    public function testConstructDefaultArgs()
    {
        $file = new File();

        $this->assertNotNull($file->getFilePath());
        $this->assertEmpty($file->getFilePath());
    }

    /**
     * Test for __construct() passing a string as the argument.
     */
    public function testConstructStringArg()
    {
        $filePath = 'testFile.pdf';
        $file = new File($filePath);

        $this->assertEquals($filePath, $file->getFilePath());
    }

    /**
     * Test for getFilePath()
     */
    public function testGetFilePath()
    {
        $filePath = 'testFile.pdf';
        $file = new File();
        $file->setFilePath($filePath);
        $result = $file->getFilePath();

        $this->assertIsString($result);
        $this->assertEquals($filePath, $result);
    }

    /**
     * Test for setFilePath()
     */
    public function testSetFilePath()
    {
        $filePath = 'testFile.pdf';
        $file = new File();
        $file->setFilePath($filePath);

        $this->assertEquals($filePath, $file->getFilePath());
    }

    /**
     * Test for getParamName()
     */
    public function testGetParamName()
    {
        $result = File::getParamName();

        $this->assertIsString($result);
        $this->assertEquals('source_bytes', $result);
    }

}