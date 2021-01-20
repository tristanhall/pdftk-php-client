<?php

namespace MinuteMan\PdftkClient\Commands;

/**
 * Class Command
 *
 * @package MinuteMan\PdftkClient\Commands
 */
abstract class Command
{

    /**
     * Returns the name of the command.
     *
     * @return string
     */
    abstract public function getCommandName(): string;

    /**
     * Return an associative array of parameter names and values for the current command.
     *
     * @return array
     */
    abstract public function getParams(): array;

}