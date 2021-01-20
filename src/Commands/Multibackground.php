<?php

namespace MinuteMan\PdftkClient\Commands;

/**
 * Class Multibackground
 *
 * @package MinuteMan\PdftkClient\Commands
 */
class Multibackground extends Stamp
{

    /**
     * @return string
     */
    public function getCommandName(): string
    {
        return 'multibackground';
    }

}