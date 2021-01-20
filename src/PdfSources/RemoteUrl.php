<?php

namespace MinuteMan\PdftkClient\PdfSources;

/**
 * Class RemoteUrl
 *
 * @package MinuteMan\PdftkClient\PdfSources
 */
class RemoteUrl extends PdfSource
{

    /**
     * The URL of PDF file.
     *
     * @var string
     */
    protected string $remoteUrl = '';

    /**
     * File constructor.
     *
     * @param string|null $remoteUrl
     */
    public function __construct(?string $remoteUrl = null)
    {
        if (is_string($remoteUrl)) {
            $this->setRemoteUrl($remoteUrl);
        }
    }

    /**
     * Returns the URL of PDF file.
     *
     * @return string
     */
    public function getRemoteUrl(): string
    {
        return $this->remoteUrl;
    }

    /**
     * Set the URL of PDF file.
     *
     * @param string $remoteUrl
     * @return $this
     */
    public function setRemoteUrl(string $remoteUrl): self
    {
        $this->remoteUrl = $remoteUrl;

        return $this;
    }

    /**
     * @return string
     */
    public static function getParamName(): string
    {
        return 'source_url';
    }

    /**
     * @return string
     */
    public function getParamValue(): string
    {
        return $this->getRemoteUrl();
    }

}