<?php

namespace Tests;

use JsonException;
use MinuteMan\PdftkClient\ApiClient;
use MinuteMan\PdftkClient\Commands\FillForm;
use MinuteMan\PdftkClient\PdfSources\RemoteUrl;
use MinuteMan\PdftkClient\PdftkDocument;
use PHPUnit\Framework\TestCase;

/**
 * Class UpdateOptionsTest
 *
 * @package Tests
 */
class UpdateOptionsTest extends TestCase
{

    /**
     * @var ApiClient
     */
    protected ApiClient $apiClient;

    /**
     * This method is called before each test.
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
    protected function makeDocumentInstance(): PdftkDocument
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
     * Test for updating the allow option
     *
     * @throws JsonException
     */
    public function testUpdateAllowOption()
    {
        $doc = $this->makeDocumentInstance();
        $doc->setAllow([0, 0, 0]);
        $optionValue = [1, 2, 3];
        $doc->setAllow($optionValue);
        $body = $this->getRequestBodyFromDoc($doc);

        $this->assertObjectHasAttribute('allow', $body->options);
        $this->assertEquals($optionValue, $body->options->allow);
    }

    /**
     * Test for updating the owner_pw option
     *
     * @throws JsonException
     */
    public function testUpdateOwnerPwOption()
    {
        $doc = $this->makeDocumentInstance();
        $doc->setOwnerPw('test1');
        $optionValue = 'test2';
        $doc->setOwnerPw($optionValue);
        $body = $this->getRequestBodyFromDoc($doc);

        $this->assertObjectHasAttribute('owner_pw', $body->options);
        $this->assertEquals($optionValue, $body->options->owner_pw);
    }

    /**
     * Test for updating the user_pw option
     *
     * @throws JsonException
     */
    public function testUpdateUserPwOption()
    {
        $doc = $this->makeDocumentInstance();
        $doc->setUserPw('test1');
        $optionValue = 'test2';
        $doc->setUserPw($optionValue);
        $body = $this->getRequestBodyFromDoc($doc);

        $this->assertObjectHasAttribute('user_pw', $body->options);
        $this->assertEquals($optionValue, $body->options->user_pw);
    }

}