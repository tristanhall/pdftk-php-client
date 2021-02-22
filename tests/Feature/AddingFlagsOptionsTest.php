<?php

namespace Tests;

use JsonException;
use MinuteMan\PdftkClient\ApiClient;
use MinuteMan\PdftkClient\Commands\FillForm;
use MinuteMan\PdftkClient\PdfSources\RemoteUrl;
use MinuteMan\PdftkClient\PdftkDocument;
use PHPUnit\Framework\TestCase;

/**
 * Class AddingFlagsOptionsTest
 *
 * @package Tests
 */
class AddingFlagsOptionsTest extends TestCase
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
     * Test for setInputPw()
     *
     * @throws JsonException
     */
    public function testSetInputPw()
    {
        $doc = $this->makeDocumentInstance();
        $doc->setInputPw();
        $body = $this->getRequestBodyFromDoc($doc);

        $this->assertContains('input_pw', $body->flags);
    }

    /**
     * Test for setFlatten()
     *
     * @throws JsonException
     */
    public function testSetFlatten()
    {
        $doc = $this->makeDocumentInstance();
        $doc->setFlatten();
        $body = $this->getRequestBodyFromDoc($doc);

        $this->assertContains('flatten', $body->flags);
    }

    /**
     * Test for setNeedAppearances()
     *
     * @throws JsonException
     */
    public function testSetNeedAppearances()
    {
        $doc = $this->makeDocumentInstance();
        $doc->setNeedAppearances();
        $body = $this->getRequestBodyFromDoc($doc);

        $this->assertContains('need_appearances', $body->flags);
    }

    /**
     * Test for setCompress()
     *
     * @throws JsonException
     */
    public function testSetCompress()
    {
        $doc = $this->makeDocumentInstance();
        $doc->setCompress();
        $body = $this->getRequestBodyFromDoc($doc);

        $this->assertContains('compress', $body->flags);
    }

    /**
     * Test for setUncompress()
     *
     * @throws JsonException
     */
    public function testSetUncompress()
    {
        $doc = $this->makeDocumentInstance();
        $doc->setUncompress();
        $body = $this->getRequestBodyFromDoc($doc);

        $this->assertContains('uncompress', $body->flags);
    }

    /**
     * Test for setKeepFirstId()
     *
     * @throws JsonException
     */
    public function testSetKeepFirstId()
    {
        $doc = $this->makeDocumentInstance();
        $doc->setKeepFirstId();
        $body = $this->getRequestBodyFromDoc($doc);

        $this->assertContains('keep_first_id', $body->flags);
    }

    /**
     * Test for setKeepFinalId()
     *
     * @throws JsonException
     */
    public function testSetKeepFinalId()
    {
        $doc = $this->makeDocumentInstance();
        $doc->setKeepFinalId();
        $body = $this->getRequestBodyFromDoc($doc);

        $this->assertContains('keep_final_id', $body->flags);
    }

    /**
     * Test for setDropXfa()
     *
     * @throws JsonException
     */
    public function testSetDropXfa()
    {
        $doc = $this->makeDocumentInstance();
        $doc->setDropXfa();
        $body = $this->getRequestBodyFromDoc($doc);

        $this->assertContains('drop_xfa', $body->flags);
    }

    /**
     * Test for setAllow()
     *
     * @throws JsonException
     */
    public function testSetAllow()
    {
        $doc = $this->makeDocumentInstance();
        $optionValue = null;
        $doc->setAllow($optionValue);
        $body = $this->getRequestBodyFromDoc($doc);

        $this->assertObjectHasAttribute('allow', $body->options);
    }

    /**
     * Test for setOwnerPw()
     *
     * @throws JsonException
     */
    public function testSetOwnerPw()
    {
        $doc = $this->makeDocumentInstance();
        $optionValue = null;
        $doc->setOwnerPw($optionValue);
        $body = $this->getRequestBodyFromDoc($doc);

        $this->assertObjectHasAttribute('owner_pw', $body->options);
    }

    /**
     * Test for setUserPw()
     *
     * @throws JsonException
     */
    public function testSetUserPw()
    {
        $doc = $this->makeDocumentInstance();
        $optionValue = null;
        $doc->setUserPw($optionValue);
        $body = $this->getRequestBodyFromDoc($doc);

        $this->assertObjectHasAttribute('user_pw', $body->options);
    }

}