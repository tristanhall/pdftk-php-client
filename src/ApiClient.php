<?php

namespace MinuteMan\PdftkClient;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;
use Exception;
use JsonException;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Request as Psr7Request;

/**
 * Class ApiClient
 * Provides an interface for creating PDF files using the Pdftk Microservice.
 *
 * @package MinuteMan\PdftkClient
 */
class ApiClient
{

    const USER_AGENT = 'mms-pdftk-php-client';

    const VERSION = '1.0.0';

    /**
     * The API URL to use for HTTP requests.
     *
     * @var string
     */
    protected string $endpointUrl = '';

    /**
     * The API key to use for authenticating HTTP requests.
     *
     * @var string
     */
    protected string $apiKey = '';

    /**
     * Initialize the basic properties.
     *
     * @param string $endpointUrl
     * @param string $apiKey
     */
    public function __construct(string $endpointUrl = '', string $apiKey = '')
    {
        $this->setEndpointUrl($endpointUrl);
        $this->setApiKey($apiKey);
    }

    /**
     * Sets a new endpoint URL to use for HTTP requests.
     *
     * @param string $endpointUrl
     * @return $this
     */
    public function setEndpointUrl(string $endpointUrl): self
    {
        $this->endpointUrl = $endpointUrl;

        return $this;
    }

    /**
     * Sets a new API key to use for HTTP requests.
     *
     * @param string $apiKey
     * @return $this
     */
    public function setApiKey(string $apiKey): self
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Creates a Request instance to send to the API.
     *
     * @param array $postData
     * @throws JsonException
     * @return Psr7Request
     */
    public function makeRequest(array $postData): Psr7Request
    {
        return new Psr7Request(
            'POST',
            $this->endpointUrl,
            [
                'User-Agent' => sprintf('%s/%s', self::USER_AGENT, self::VERSION),
                'X-Api-Key'  => $this->apiKey,
                'Accept'     => 'application/pdf',
            ],
            json_encode($postData, JSON_THROW_ON_ERROR)
        );
    }

    /**
     * @param Psr7Request $request
     * @throws GuzzleException|Exception
     * @return ResponseInterface
     */
    public function sendRequest(Psr7Request $request): ResponseInterface
    {
        $response = (new HttpClient())->send($request);

        if ($response->getStatusCode() === 200) {
            return $response;
        } else {
            throw new Exception(sprintf(
                'Unexpected Response: %d %s %s',
                $response->getStatusCode(),
                $response->getReasonPhrase(),
                (string)$response->getBody()->getContents()
            ));
        }
    }

}