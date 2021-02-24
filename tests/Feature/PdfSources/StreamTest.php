<?php

namespace Tests\PdfSources;

use MinuteMan\PdftkClient\PdfSources\Stream;
use PHPUnit\Framework\TestCase;

/**
 * Class StreamTest
 *
 * @package Tests\PdfSources
 */
class StreamTest extends TestCase
{

    /**
     * Test for __construct() using the default arguments.
     */
    public function testConstructDefaultArgs()
    {
        $file = new Stream();

        $this->assertEmpty($file->getResource());
    }

    /**
     * Test for __construct() passing a resource as the argument.
     */
    public function testConstructResourceArg()
    {
        $resource = opendir('/.');
        $file = new Stream($resource);

        $this->assertEquals($resource, $file->getResource());
        closedir($resource);
    }

    /**
     * Test for __construct() passing a non-string as the argument.
     */
    public function testConstructNonResourceArg()
    {
        $resource = '/.';
        $file = new Stream($resource);

        $this->assertEmpty($file->getResource());
    }

    /**
     * Test for getResource()
     */
    public function testGetResource()
    {
        $resource = opendir('/.');
        $file = new Stream();
        $file->setResource($resource);
        $result = $file->getResource();

        $this->assertIsResource($result);
        $this->assertEquals($resource, $result);
        closedir($resource);
    }

    /**
     * Test for setResource()
     */
    public function testSetResource()
    {
        $resource = opendir('/.');
        $file = new Stream();
        $file->setResource($resource);

        $this->assertEquals($resource, $file->getResource());
        closedir($resource);
    }

    /**
     * Test for getParamName()
     */
    public function testGetParamName()
    {
        $result = Stream::getParamName();

        $this->assertIsString($result);
        $this->assertEquals('source_bytes', $result);
    }

}