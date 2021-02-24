<?php

namespace Tests\Commands;

use Error;
use MinuteMan\PdftkClient\Commands\Stamp;
use MinuteMan\PdftkClient\PdfSources\PdfSource;
use MinuteMan\PdftkClient\PdfSources\RemoteUrl;
use PHPUnit\Framework\TestCase;

/**
 * Class StampTest
 *
 * @package Tests\Commands
 */
class StampTest extends TestCase
{

    /**
     * Test for __construct where the $sourcePdf argument is null.
     */
    public function testConstructSourcePdfNull()
    {
        $cmd = new Stamp(null);

        try {
            $result = $cmd->getSourcePdf();
        } catch (Error $e) {
            $result = $e;
        }

        $this->assertInstanceOf(Error::class, $result);
    }

    /**
     * Test for __construct where the $sourcePdf argument is not null.
     */
    public function testConstructSourcePdfNotNull()
    {
        $sourcePdf = new RemoteUrl();
        $cmd = new Stamp($sourcePdf);
        $result = $cmd->getSourcePdf();

        $this->assertTrue($result instanceof PdfSource);
        $this->assertEquals($sourcePdf, $result);
    }

    /**
     * Test for getSourcePdf()
     */
    public function testGetSourcePdf()
    {
        $sourcePdf = new RemoteUrl('www.google.com');
        $cmd = new Stamp($sourcePdf);
        $result = $cmd->getSourcePdf();

        $this->assertInstanceOf(RemoteUrl::class, $result);
    }

    /**
     * Test for setSourcePdf()
     */
    public function testSetSourcePdf()
    {
        $sourcePdf = new RemoteUrl('www.google.com');
        $cmd = new Stamp();
        $cmd->setSourcePdf($sourcePdf);
        $result = $cmd->getSourcePdf();

        $this->assertEquals($result, $sourcePdf);
    }

    /**
     * Test for getParams()
     */
    public function testGetParams()
    {
        $cmd = new Stamp(new RemoteUrl('www.google.com'));
        $result = $cmd->getParams();

        $this->assertIsArray($result);
        $this->assertEquals(['source_url' => 'www.google.com'], $result);
    }

    /**
     * Test for getCommandName()
     */
    public function testGetCommandName()
    {
        $cmd = new Stamp();
        $result = $cmd->getCommandName();

        $this->assertIsString($result);
        $this->assertEquals('stamp', $result);
    }

}