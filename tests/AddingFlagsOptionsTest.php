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
     * Test for unsetInputPw()
     *
     * @throws JsonException
     */
    public function testUnsetInputPw()
    {
        $doc = $this->makeDocumentInstance();
        $doc->setInputPw();
        $doc->unsetInputPw();
        $body = $this->getRequestBodyFromDoc($doc);

        $this->assertNotContains('input_pw', $body->flags);
    }

    /**
     * Test for unsetFlatten()
     *
     * @throws JsonException
     */
    public function testUnsetFlatten()
    {
        $doc = $this->makeDocumentInstance();
        $doc->setFlatten();
        $doc->unsetFlatten();
        $body = $this->getRequestBodyFromDoc($doc);

        $this->assertNotContains('flatten', $body->flags);
    }

    /**
     * Test for unsetNeedAppearances()
     *
     * @throws JsonException
     */
    public function testUnsetNeedAppearances()
    {
        $doc = $this->makeDocumentInstance();
        $doc->setNeedAppearances();
        $doc->unsetNeedAppearances();
        $body = $this->getRequestBodyFromDoc($doc);

        $this->assertNotContains('need_appearances', $body->flags);
    }

    /**
     * Test for unsetCompress()
     *
     * @throws JsonException
     */
    public function testUnsetCompress()
    {
        $doc = $this->makeDocumentInstance();
        $doc->setCompress();
        $doc->unsetCompress();
        $body = $this->getRequestBodyFromDoc($doc);

        $this->assertNotContains('compress', $body->flags);
    }

    /**
     * Test for unsetUncompress()
     *
     * @throws JsonException
     */
    public function testUnsetUncompress()
    {
        $doc = $this->makeDocumentInstance();
        $doc->setUncompress();
        $doc->unsetUncompress();
        $body = $this->getRequestBodyFromDoc($doc);

        $this->assertNotContains('uncompress', $body->flags);
    }

    /**
     * Test for unsetKeepFirstId()
     *
     * @throws JsonException
     */
    public function testUnsetKeepFirstId()
    {
        $doc = $this->makeDocumentInstance();
        $doc->setKeepFirstId();
        $doc->unsetKeepFirstId();
        $body = $this->getRequestBodyFromDoc($doc);

        $this->assertNotContains('keep_first_id', $body->flags);
    }

    /**
     * Test for unsetKeepFinalId()
     *
     * @throws JsonException
     */
    public function testUnsetKeepFinalId()
    {
        $doc = $this->makeDocumentInstance();
        $doc->setKeepFinalId();
        $doc->unsetKeepFinalId();
        $body = $this->getRequestBodyFromDoc($doc);

        $this->assertNotContains('keep_final_id', $body->flags);
    }

    /**
     * Test for unsetDropXfa()
     *
     * @throws JsonException
     */
    public function testUnsetDropXfa()
    {
        $doc = $this->makeDocumentInstance();
        $doc->setDropXfa();
        $doc->unsetDropXfa();
        $body = $this->getRequestBodyFromDoc($doc);

        $this->assertNotContains('drop_xfa', $body->flags);
    }

    /**
     * Test for unsetAllow()
     *
     * @throws JsonException
     */
    public function testUnsetAllow()
    {
        $doc = $this->makeDocumentInstance();
        $optionValue = null;
        $doc->setAllow($optionValue);
        $doc->unsetAllow();
        $body = $this->getRequestBodyFromDoc($doc);

        $this->assertNotContains('allow', $body->options);
    }

    /**
     * Test for unsetOwnerPw()
     *
     * @throws JsonException
     */
    public function testUnsetOwnerPw()
    {
        $doc = $this->makeDocumentInstance();
        $optionValue = null;
        $doc->setOwnerPw($optionValue);
        $doc->unsetOwnerPw();
        $body = $this->getRequestBodyFromDoc($doc);

        $this->assertNotContains('owner_pw', $body->options);
    }

    /**
     * Test for unsetUserPw()
     *
     * @throws JsonException
     */
    public function testUnsetUserPw()
    {
        $doc = $this->makeDocumentInstance();
        $optionValue = null;
        $doc->setUserPw($optionValue);
        $doc->unsetUserPw();
        $body = $this->getRequestBodyFromDoc($doc);

        $this->assertNotContains('user_pw', $body->options);
    }

}