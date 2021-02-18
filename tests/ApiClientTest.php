<?php

namespace Tests;

use GuzzleHttp\Psr7\Request as Psr7Request;
use MinuteMan\PdftkClient\ApiClient;
use PHPUnit\Framework\TestCase;

/**
 * Class ApiClientTest
 *
 * @package Tests
 */
class ApiClientTest extends TestCase
{

    /**
     * Test for __construct() using the default arguments.
     */
    public function testConstructDefaultArgs()
    {
        $apiClient = new ApiClient();

        $this->assertEmpty($apiClient->makeRequest([])->getUri()->getPath());
        $this->assertEmpty($apiClient->makeRequest([])->getHeader('X-Api-Key')[0]);
    }

    /**
     * Test for __construct() using provided arguments.
     */
    public function testConstructProvidedArgs()
    {
        $url = 'www.test.com';
        $apiKey = 'test123';
        $apiClient = new ApiClient($url, $apiKey);

        $this->assertEquals($url, $apiClient->makeRequest([])->getUri()->getPath());
        $this->assertEquals($apiKey, $apiClient->makeRequest([])->getHeader('X-Api-Key')[0]);
    }

    /**
     * Test for setEndpointUrl()
     */
    public function testSetEndpointUrl()
    {
        $url = 'www.test.com';
        $apiKey = '';
        $apiClient = new ApiClient($url, $apiKey);

        $this->assertEquals($url, $apiClient->makeRequest([])->getUri()->getPath());
    }

    /**
     * Test for setApiKey()
     */
    public function testSetApiKey()
    {
        $url = '';
        $apiKey = 'test123';
        $apiClient = new ApiClient($url, $apiKey);

        $this->assertEquals($apiKey, $apiClient->makeRequest([])->getHeader('X-Api-Key')[0]);
    }

    /**
     * Test for makeRequest() where the POST data is an empty array.
     */
    public function testMakeRequestEmptyPostData()
    {
        $url = 'www.test.com';
        $apiKey = 'test123';
        $apiClient = new ApiClient($url, $apiKey);
        $postData = [];
        $result = $apiClient->makeRequest($postData);

        $this->assertTrue($result instanceof Psr7Request);
    }

    /**
     * Test for makeRequest() where the POST data is a non-empty array.
     */
    public function testMakeRequestNonEmptyPostData()
    {
        $url = 'www.test.com';
        $apiKey = 'test123';
        $apiClient = new ApiClient($url, $apiKey);
        $postData = ['one' => 1];
        $result = $apiClient->makeRequest($postData);

        $this->assertTrue($result instanceof Psr7Request);
    }

}