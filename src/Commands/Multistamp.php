<?php

namespace MinuteMan\PdftkClient\Commands;

/**
 * Class Multistamp
 *
 * @package MinuteMan\PdftkClient\Commands
 */
class Multistamp extends Stamp
{

    /**
     * @return string
     */
    public function getCommandName(): string
    {
        return 'multistamp';
    }

}