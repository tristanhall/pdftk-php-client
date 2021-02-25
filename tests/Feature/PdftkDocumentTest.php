<?php

namespace Tests;

use MinuteMan\PdftkClient\ApiClient;
use MinuteMan\PdftkClient\PdfSources\RemoteUrl;
use MinuteMan\PdftkClient\PdftkDocument;
use MinuteMan\PdftkClient\PdfSources\PdfSource;
use MinuteMan\PdftkClient\PdfSources\File;
use MinuteMan\PdftkClient\Commands\FillForm;
use PHPUnit\Framework\TestCase;

class PdftkDocumentTest extends TestCase
{

    /**
     * @var ApiClient
     */
    protected ApiClient $apiClient;

    /**
     * setUp()
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->apiClient = new ApiClient('https://wkhtmltopdf.local/pdf');
    }

    /**
     * Test for getApiClient()
     */
    public function testGetApiClient()
    {
        $doc = new PdftkDocument($this->apiClient);
        $result = $doc->getApiClient();

        $this->assertInstanceOf(ApiClient::class, $result);
    }

    /**
     * Test for getSourcePdf()
     */
    public function testGetSourcePdf()
    {
        $doc = new PdftkDocument($this->apiClient);
        $sourcePdf = new RemoteUrl('www.google.com');
        $doc->setSourcePdf($sourcePdf);
        $result = $doc->getSourcePdf();

        $this->assertInstanceOf(RemoteUrl::class, $result);
        $this->assertEquals($sourcePdf, $result);
    }

    /**
     * Test for setSourcePdf()
     */
    public function testSetSourcePdf()
    {
        $doc = new PdftkDocument($this->apiClient);
        $sourcePdf = new RemoteUrl('www.google.com');
        $doc->setSourcePdf($sourcePdf);
        $result = $doc->getSourcePdf();

        $this->assertInstanceOf(RemoteUrl::class, $result);
        $this->assertEquals($sourcePdf, $result);
    }

    /**
     * Test for setCommands()
     */
    public function testSetCommand()
    {
        $doc = new PdftkDocument($this->apiClient);
        $cmd = new FillForm();
        $doc->setCommand($cmd);
        $result = $doc->getCommand();

        $this->assertInstanceOf(FillForm::class, $result);
        $this->assertEquals($cmd, $result);
    }

    /**
     * Test for getCommands()
     */
    public function testGetCommand()
    {
        $doc = new PdftkDocument($this->apiClient);
        $cmd = new FillForm();
        $doc->setCommand($cmd);
        $result = $doc->getCommand();

        $this->assertInstanceOf(FillForm::class, $result);
        $this->assertEquals($cmd, $result);
    }

    /**
     * Test for getFlags()
     */
    public function testGetFlags()
    {
        $doc = new PdftkDocument($this->apiClient);
        $result = $doc->getFlags();

        $this->assertIsArray($result);
    }

    /**
     * Test for getOptions()
     */
    public function testGetOptions()
    {
        $doc = new PdftkDocument($this->apiClient);
        $result = $doc->getOptions();

        $this->assertIsArray($result);
    }

    /**
     * Test for getParams()
     */
    public function testGetParams()
    {
        $doc = new PdftkDocument($this->apiClient);
        $sourcePdf = new RemoteUrl('www.google.com');
        $doc->setSourcePdf($sourcePdf);
        $cmd = new FillForm();
        $doc->setCommand($cmd);
        $result = $doc->getParams();

        $this->assertIsArray($result);
    }

}