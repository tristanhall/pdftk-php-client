<?php

namespace MinuteMan\PdftkClient\PdfSources;

use Exception;
use InvalidArgumentException;

/**
 * Class Stream
 *
 * @package MinuteMan\PdftkClient\PdfSources
 */
class Stream extends PdfSource
{

    /**
     * The resource to use for reading the PDF content.
     *
     * @var resource
     */
    protected $resource;

    /**
     * Stream constructor.
     *
     * @param resource|null $resource
     */
    public function __construct($resource = null)
    {
        if (is_resource($resource)) {
            $this->setResource($resource);
        }
    }

    /**
     * Returns the stream resource for the PDF file.
     *
     * @return resource
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Set the stream resource of the PDF file.
     *
     * @param resource $resource
     * @return $this
     */
    public function setResource($resource): self
    {
        if (is_resource($resource)) {
            $this->resource = $resource;
        }

        return $this;
    }

    /**
     * @return string
     */
    public static function getParamName(): string
    {
        return 'source_bytes';
    }

    /**
     * Retrieve the stream resource, add Base64 encoding, then return the contents of the resource.
     *
     * @throws Exception
     * @return string
     */
    public function getParamValue(): string
    {
        $resource = $this->getResource();

        if (is_resource($resource)) {
            stream_filter_append($resource, 'convert.base64-encode');

            return stream_get_contents($resource);
        } else {
            throw new InvalidArgumentException("Invalid resource provided.");
        }
    }

}