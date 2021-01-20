<?php

namespace MinuteMan\PdftkClient\PdfSources;

use Exception;

/**
 * Class File
 *
 * @package MinuteMan\PdftkClient\PdfSources
 */
class File extends PdfSource
{

    /**
     * The absolute path to the local PDF file.
     *
     * @var string
     */
    protected string $filePath = '';

    /**
     * File constructor.
     *
     * @param string|null $filePath
     */
    public function __construct(?string $filePath = null)
    {
        if (is_string($filePath)) {
            $this->setFilePath($filePath);
        }
    }

    /**
     * Returns the absolute path to the PDF file.
     *
     * @return string
     */
    public function getFilePath(): string
    {
        return $this->filePath;
    }

    /**
     * Set the path of the PDF file.
     *
     * @param string $filePath
     * @return $this
     */
    public function setFilePath(string $filePath): self
    {
        $this->filePath = $filePath;

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
     * Retrieve the content of the PDF file, apply Base64 encoding, then return the string.
     *
     * @throws Exception
     * @return string
     */
    public function getParamValue(): string
    {
        if (file_exists($this->getFilePath())) {
            return base64_encode(file_get_contents($this->getFilePath()));
        } else {
            throw new Exception(sprintf("File %s does not exist.", $this->getFilePath()));
        }
    }

}