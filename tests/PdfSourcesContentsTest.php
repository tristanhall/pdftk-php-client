<?php

namespace Tests;

use MinuteMan\PdftkClient\PdfSources\File;
use MinuteMan\PdftkClient\PdfSources\RemoteUrl;
use MinuteMan\PdftkClient\PdfSources\Stream;
use PHPUnit\Framework\TestCase;

/**
 * Class PdfSourcesContentsTest
 *
 * @package Tests
 */
class PdfSourcesContentsTest extends TestCase
{

    /**
     * URL of the test file to use.
     */
    const TEST_PDF_URL = "https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf";

    /**
     * @var string
     */
    protected string $testPdfFile = "";

    /**
     * Override for setUpBeforeClass() method to create the test PDF file.
     */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        $testPdfFile = basename(self::TEST_PDF_URL);

        if (!file_exists($testPdfFile)) {
            file_put_contents($testPdfFile, file_get_contents(self::TEST_PDF_URL));
        }
    }

    /**
     * Override for tearDownAfterClass() method to delete the test PDF file.
     */
    public static function tearDownAfterClass(): void
    {
        $testPdfFile = basename(self::TEST_PDF_URL);

        if (file_exists($testPdfFile)) {
            unlink($testPdfFile);
        }

        parent::tearDownAfterClass();
    }

    /**
     * Override for setUp() method.
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->testPdfFile = basename(self::TEST_PDF_URL);
    }

    /**
     * Test for the File PdfSource class.
     *
     * @throws \Exception
     */
    public function testFile()
    {
        $pdfSource = new File($this->testPdfFile);
        $paramValue = base64_decode($pdfSource->getParamValue());
        $fileContents = file_get_contents($this->testPdfFile);

        $this->assertEquals(md5($fileContents), md5($paramValue));
    }

    /**
     * Test for the RemoteUrl PdfSource class.
     */
    public function testRemoteUrl()
    {
        $pdfSource = new RemoteUrl(self::TEST_PDF_URL);
        $paramValue = file_get_contents($pdfSource->getParamValue());
        $fileContents = file_get_contents(self::TEST_PDF_URL);

        $this->assertEquals(md5($fileContents), md5($paramValue));
    }

    /**
     * Test for the Stream PdfSource class.
     *
     * @throws \Exception
     */
    public function testStream()
    {
        $resource = fopen($this->testPdfFile, 'r');
        $pdfSource = new Stream($resource);
        $paramValue = base64_decode($pdfSource->getParamValue());
        $fileContents = file_get_contents($this->testPdfFile);

        $this->assertEquals(md5($fileContents), md5($paramValue));
        fclose($resource);
    }

}