<?php

namespace Tests;

use JsonException;
use MinuteMan\PdftkClient\ApiClient;
use MinuteMan\PdftkClient\Commands\Background;
use MinuteMan\PdftkClient\Commands\FillForm;
use MinuteMan\PdftkClient\Commands\Multibackground;
use MinuteMan\PdftkClient\Commands\Multistamp;
use MinuteMan\PdftkClient\Commands\Rotate;
use MinuteMan\PdftkClient\Commands\Stamp;
use MinuteMan\PdftkClient\PdfSources\RemoteUrl;
use MinuteMan\PdftkClient\PdftkDocument;
use PHPUnit\Framework\TestCase;

/**
 * Class AddingCommandsTest
 *
 * @package Tests
 */
class AddingCommandsTest extends TestCase
{

    /**
     * @var ApiClient
     */
    protected $apiClient;

    /**
     * @var string
     */
    protected $sourceUrl = 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf';

    /**
     * setUp()
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->apiClient = new ApiClient('https://wkhtmltopdf.local/pdf');
    }

    /**
     * Create a new instance of WkhtmltopdfDocument and set HTML markup.
     *
     * @return PdftkDocument
     */
    protected function getDocumentInstance(): PdftkDocument
    {
        $doc = new PdftkDocument($this->apiClient);
        $doc->setSourcePdf(new RemoteUrl());
        $doc->setCommand(new FillForm());

        return $doc;
    }

    /**
     * Gets the decoded JSON body from the request that a document generates.
     *
     * @param PdftkDocument $doc
     * @return mixed
     * @throws JsonException
     */
    protected function getRequestBodyFromDoc(PdftkDocument $doc)
    {
        $request = $doc->getApiClient()->makeRequest($doc->getParams());

        return json_decode($request->getBody()->getContents());
    }

    /**
     * Test for setting the FillForm command in a PdftkDocument instance.
     *
     * @throws JsonException
     */
    public function testFillFormCommand()
    {
        $doc = $this->getDocumentInstance();
        $cmd = new FillForm(['one' => 1]);
        $doc->setCommand($cmd);
        $body = $this->getRequestBodyFromDoc($doc);

        $this->assertObjectHasAttribute($cmd->getCommandName(), $body);
        $this->assertEquals($cmd->getParams(), (array)$body->{$cmd->getCommandName()});
    }

    /**
     * Test for setting the Background command in a PdftkDocument instance.
     *
     * @throws JsonException
     */
    public function testBackgroundCommand()
    {
        $doc = $this->getDocumentInstance();
        $cmd = new Background(new RemoteUrl($this->sourceUrl));
        $doc->setCommand($cmd);
        $body = $this->getRequestBodyFromDoc($doc);

        $this->assertObjectHasAttribute($cmd->getCommandName(), $body);
        $this->assertEquals($this->sourceUrl, $body->background->source_url);
    }

    /**
     * Test for setting the Multibackground command in a PdftkDocument instance.
     *
     * @throws JsonException
     */
    public function testMultibackgroundCommand()
    {
        $doc = $this->getDocumentInstance();
        $cmd = new Multibackground(new RemoteUrl($this->sourceUrl));
        $doc->setCommand($cmd);
        $body = $this->getRequestBodyFromDoc($doc);

        $this->assertObjectHasAttribute($cmd->getCommandName(), $body);
        $this->assertEquals($this->sourceUrl, $body->multibackground->source_url);
    }

    /**
     * Test for setting the Multistamp command in a PdftkDocument instance.
     *
     * @throws JsonException
     */
    public function testMultistampCommand()
    {
        $doc = $this->getDocumentInstance();
        $cmd = new Multistamp(new RemoteUrl($this->sourceUrl));
        $doc->setCommand($cmd);
        $body = $this->getRequestBodyFromDoc($doc);

        $this->assertObjectHasAttribute($cmd->getCommandName(), $body);
        $this->assertEquals($this->sourceUrl, $body->multistamp->source_url);
    }

    /**
     * Test for setting the Stamp command in a PdftkDocument instance.
     *
     * @throws JsonException
     */
    public function testStampCommand()
    {
        $doc = $this->getDocumentInstance();
        $cmd = new Stamp(new RemoteUrl($this->sourceUrl));
        $doc->setCommand($cmd);
        $body = $this->getRequestBodyFromDoc($doc);

        $this->assertObjectHasAttribute($cmd->getCommandName(), $body);
        $this->assertEquals($this->sourceUrl, $body->stamp->source_url);
    }

    /**
     * Test for setting the Rotate command in a PdftkDocument instance.
     *
     * @throws JsonException
     */
    public function testRotateCommand()
    {
        $doc = $this->getDocumentInstance();
        $cmd = new Rotate(90, 1, 4, 'even');
        $doc->setCommand($cmd);
        $body = $this->getRequestBodyFromDoc($doc);

        $this->assertObjectHasAttribute($cmd->getCommandName(), $body);
        $this->assertEquals(90, $body->rotate->rotation);
        $this->assertEquals(1, $body->rotate->start);
        $this->assertEquals(4, $body->rotate->end);
        $this->assertEquals('even', $body->rotate->qualifier);
    }

}