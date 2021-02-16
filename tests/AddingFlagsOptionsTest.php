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
    protected $apiClient;

    /**
     * setUp()
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->apiClient = new ApiClient('https://wkhtmltopdf.local/pdf');
    }

    /**
     * Test for setInputPw()
     *
     * @throws JsonException
     */
    public function testSetInputPw()
    {
        $doc = new PdftkDocument($this->apiClient);
        $doc->setSourcePdf(new RemoteUrl());
        $doc->setCommand(new FillForm());
        $doc->setInputPw();
        $request = $doc->getApiClient()->makeRequest($doc->getParams());
        $body = json_decode($request->getBody()->getContents());

        $this->assertContains('input_pw', $body->flags);
    }

    /**
     * Test for setFlatten()
     *
     * @throws JsonException
     */
    public function testSetFlatten()
    {
        $doc = new PdftkDocument($this->apiClient);
        $doc->setSourcePdf(new RemoteUrl());
        $doc->setCommand(new FillForm());
        $doc->setFlatten();
        $request = $doc->getApiClient()->makeRequest($doc->getParams());
        $body = json_decode($request->getBody()->getContents());

        $this->assertContains('flatten', $body->flags);
    }

    /**
     * Test for setNeedAppearances()
     *
     * @throws JsonException
     */
    public function testSetNeedAppearances()
    {
        $doc = new PdftkDocument($this->apiClient);
        $doc->setSourcePdf(new RemoteUrl());
        $doc->setCommand(new FillForm());
        $doc->setNeedAppearances();
        $request = $doc->getApiClient()->makeRequest($doc->getParams());
        $body = json_decode($request->getBody()->getContents());

        $this->assertContains('need_appearances', $body->flags);
    }

    /**
     * Test for setCompress()
     *
     * @throws JsonException
     */
    public function testSetCompress()
    {
        $doc = new PdftkDocument($this->apiClient);
        $doc->setSourcePdf(new RemoteUrl());
        $doc->setCommand(new FillForm());
        $doc->setCompress();
        $request = $doc->getApiClient()->makeRequest($doc->getParams());
        $body = json_decode($request->getBody()->getContents());

        $this->assertContains('compress', $body->flags);
    }

    /**
     * Test for setUncompress()
     *
     * @throws JsonException
     */
    public function testSetUncompress()
    {
        $doc = new PdftkDocument($this->apiClient);
        $doc->setSourcePdf(new RemoteUrl());
        $doc->setCommand(new FillForm());
        $doc->setUncompress();
        $request = $doc->getApiClient()->makeRequest($doc->getParams());
        $body = json_decode($request->getBody()->getContents());

        $this->assertContains('uncompress', $body->flags);
    }

    /**
     * Test for setKeepFirstId()
     *
     * @throws JsonException
     */
    public function testSetKeepFirstId()
    {
        $doc = new PdftkDocument($this->apiClient);
        $doc->setSourcePdf(new RemoteUrl());
        $doc->setCommand(new FillForm());
        $doc->setKeepFirstId();
        $request = $doc->getApiClient()->makeRequest($doc->getParams());
        $body = json_decode($request->getBody()->getContents());

        $this->assertContains('keep_first_id', $body->flags);
    }

    /**
     * Test for setKeepFinalId()
     *
     * @throws JsonException
     */
    public function testSetKeepFinalId()
    {
        $doc = new PdftkDocument($this->apiClient);
        $doc->setSourcePdf(new RemoteUrl());
        $doc->setCommand(new FillForm());
        $doc->setKeepFinalId();
        $request = $doc->getApiClient()->makeRequest($doc->getParams());
        $body = json_decode($request->getBody()->getContents());

        $this->assertContains('keep_final_id', $body->flags);
    }

    /**
     * Test for setDropXfa()
     *
     * @throws JsonException
     */
    public function testSetDropXfa()
    {
        $doc = new PdftkDocument($this->apiClient);
        $doc->setSourcePdf(new RemoteUrl());
        $doc->setCommand(new FillForm());
        $doc->setDropXfa();
        $request = $doc->getApiClient()->makeRequest($doc->getParams());
        $body = json_decode($request->getBody()->getContents());

        $this->assertContains('drop_xfa', $body->flags);
    }

    /**
     * Test for unsetInputPw()
     *
     * @throws JsonException
     */
    public function testUnsetInputPw()
    {
        $doc = new PdftkDocument($this->apiClient);
        $doc->setSourcePdf(new RemoteUrl());
        $doc->setCommand(new FillForm());
        $doc->setInputPw();
        $doc->unsetInputPw();
        $request = $doc->getApiClient()->makeRequest($doc->getParams());
        $body = json_decode($request->getBody()->getContents());

        $this->assertNotContains('input_pw', $body->flags);
    }

    /**
     * Test for unsetFlatten()
     *
     * @throws JsonException
     */
    public function testUnsetFlatten()
    {
        $doc = new PdftkDocument($this->apiClient);
        $doc->setSourcePdf(new RemoteUrl());
        $doc->setCommand(new FillForm());
        $doc->setFlatten();
        $doc->unsetFlatten();
        $request = $doc->getApiClient()->makeRequest($doc->getParams());
        $body = json_decode($request->getBody()->getContents());

        $this->assertNotContains('flatten', $body->flags);
    }

    /**
     * Test for unsetNeedAppearances()
     *
     * @throws JsonException
     */
    public function testUnsetNeedAppearances()
    {
        $doc = new PdftkDocument($this->apiClient);
        $doc->setSourcePdf(new RemoteUrl());
        $doc->setCommand(new FillForm());
        $doc->setNeedAppearances();
        $doc->unsetNeedAppearances();
        $request = $doc->getApiClient()->makeRequest($doc->getParams());
        $body = json_decode($request->getBody()->getContents());

        $this->assertNotContains('need_appearances', $body->flags);
    }

    /**
     * Test for unsetCompress()
     *
     * @throws JsonException
     */
    public function testUnsetCompress()
    {
        $doc = new PdftkDocument($this->apiClient);
        $doc->setSourcePdf(new RemoteUrl());
        $doc->setCommand(new FillForm());
        $doc->setCompress();
        $doc->unsetCompress();
        $request = $doc->getApiClient()->makeRequest($doc->getParams());
        $body = json_decode($request->getBody()->getContents());

        $this->assertNotContains('compress', $body->flags);
    }

    /**
     * Test for unsetUncompress()
     *
     * @throws JsonException
     */
    public function testUnsetUncompress()
    {
        $doc = new PdftkDocument($this->apiClient);
        $doc->setSourcePdf(new RemoteUrl());
        $doc->setCommand(new FillForm());
        $doc->setUncompress();
        $doc->unsetUncompress();
        $request = $doc->getApiClient()->makeRequest($doc->getParams());
        $body = json_decode($request->getBody()->getContents());

        $this->assertNotContains('uncompress', $body->flags);
    }

    /**
     * Test for unsetKeepFirstId()
     *
     * @throws JsonException
     */
    public function testUnsetKeepFirstId()
    {
        $doc = new PdftkDocument($this->apiClient);
        $doc->setSourcePdf(new RemoteUrl());
        $doc->setCommand(new FillForm());
        $doc->setKeepFirstId();
        $doc->unsetKeepFirstId();
        $request = $doc->getApiClient()->makeRequest($doc->getParams());
        $body = json_decode($request->getBody()->getContents());

        $this->assertNotContains('keep_first_id', $body->flags);
    }

    /**
     * Test for unsetKeepFinalId()
     *
     * @throws JsonException
     */
    public function testUnsetKeepFinalId()
    {
        $doc = new PdftkDocument($this->apiClient);
        $doc->setSourcePdf(new RemoteUrl());
        $doc->setCommand(new FillForm());
        $doc->setKeepFinalId();
        $doc->unsetKeepFinalId();
        $request = $doc->getApiClient()->makeRequest($doc->getParams());
        $body = json_decode($request->getBody()->getContents());

        $this->assertNotContains('keep_final_id', $body->flags);
    }

    /**
     * Test for unsetDropXfa()
     *
     * @throws JsonException
     */
    public function testUnsetDropXfa()
    {
        $doc = new PdftkDocument($this->apiClient);
        $doc->setSourcePdf(new RemoteUrl());
        $doc->setCommand(new FillForm());
        $doc->setDropXfa();
        $doc->unsetDropXfa();
        $request = $doc->getApiClient()->makeRequest($doc->getParams());
        $body = json_decode($request->getBody()->getContents());

        $this->assertNotContains('drop_xfa', $body->flags);
    }

    /**
     * Test for unsetAllow()
     *
     * @throws JsonException
     */
    public function testUnsetAllow()
    {
        $doc = new PdftkDocument($this->apiClient);
        $doc->setSourcePdf(new RemoteUrl());
        $doc->setCommand(new FillForm());
        $optionValue = null;
        $doc->setAllow($optionValue);
        $doc->unsetAllow();
        $request = $doc->getApiClient()->makeRequest($doc->getParams());
        $body = json_decode($request->getBody()->getContents());

        $this->assertNotContains('allow', $body->options);
    }

    /**
     * Test for unsetOwnerPw()
     *
     * @throws JsonException
     */
    public function testUnsetOwnerPw()
    {
        $doc = new PdftkDocument($this->apiClient);
        $doc->setSourcePdf(new RemoteUrl());
        $doc->setCommand(new FillForm());
        $optionValue = null;
        $doc->setOwnerPw($optionValue);
        $doc->unsetOwnerPw();
        $request = $doc->getApiClient()->makeRequest($doc->getParams());
        $body = json_decode($request->getBody()->getContents());

        $this->assertNotContains('owner_pw', $body->options);
    }

    /**
     * Test for unsetUserPw()
     *
     * @throws JsonException
     */
    public function testUnsetUserPw()
    {
        $doc = new PdftkDocument($this->apiClient);
        $doc->setSourcePdf(new RemoteUrl());
        $doc->setCommand(new FillForm());
        $optionValue = null;
        $doc->setUserPw($optionValue);
        $doc->unsetUserPw();
        $request = $doc->getApiClient()->makeRequest($doc->getParams());
        $body = json_decode($request->getBody()->getContents());

        $this->assertNotContains('user_pw', $body->options);
    }

}