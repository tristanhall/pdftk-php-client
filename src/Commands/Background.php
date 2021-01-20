<?php

namespace MinuteMan\PdftkClient\Commands;

/**
 * Class Background
 *
 * @package MinuteMan\PdftkClient\Commands
 */
class Background extends Stamp
{

    /**
     * @return string
     */
    public function getCommandName(): string
    {
        return 'background';
    }

}