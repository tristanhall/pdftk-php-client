<?php

namespace Tests\PdfSources;

use MinuteMan\PdftkClient\PdfSources\RemoteUrl;
use PHPUnit\Framework\TestCase;

class RemoteUrlTest extends TestCase
{

    /**
     * Test for __construct() using the default arguments.
     */
    public function testConstructDefaultArgs()
    {
        $file = new RemoteUrl();

        $this->assertNotNull($file->getRemoteUrl());
        $this->assertEmpty($file->getRemoteUrl());
    }

    /**
     * Test for __construct() passing a string as the argument.
     */
    public function testConstructStringArg()
    {
        $url = 'www.test.com';
        $file = new RemoteUrl($url);

        $this->assertEquals($url, $file->getRemoteUrl());
    }

    /**
     * Test for getRemoteUrl()
     */
    public function testGetRemoteUrl()
    {
        $url = 'www.test.com';
        $file = new RemoteUrl();
        $file->setRemoteUrl($url);
        $result = $file->getRemoteUrl();

        $this->assertIsString($result);
        $this->assertEquals($url, $result);
    }

    /**
     * Test for setRemoteUrl()
     */
    public function testSetRemoteUrl()
    {
        $url = 'www.test.com';
        $file = new RemoteUrl();
        $file->setRemoteUrl($url);

        $this->assertEquals($url, $file->getRemoteUrl());
    }

    /**
     * Test for getParamName()
     */
    public function testGetParamName()
    {
        $result = RemoteUrl::getParamName();

        $this->assertIsString($result);
        $this->assertEquals('source_url', $result);
    }

    /**
     * Test for getParamValue()
     */
    public function testGetParamValue()
    {
        $url = 'www.test.com';
        $file = new RemoteUrl($url);

        $this->assertEquals($url, $file->getParamValue());
    }

}