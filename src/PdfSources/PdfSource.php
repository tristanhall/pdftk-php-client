<?php

namespace MinuteMan\PdftkClient\PdfSources;

/**
 * Class PdfSource
 *
 * @package MinuteMan\PdftkClient\PdfSources
 */
abstract class PdfSource
{

    /**
     * Return the name of the parameter to send to the API for the current PDF input.
     *
     * @return string
     */
    abstract public static function getParamName(): string;

    /**
     * Return the contents of the PDF input type to send to the API.
     *
     * @return string
     */
    abstract public function getParamValue(): string;

}