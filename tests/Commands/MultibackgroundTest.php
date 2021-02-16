<?php

namespace Tests\Commands;

use MinuteMan\PdftkClient\Commands\Multibackground;
use PHPUnit\Framework\TestCase;

class MultibackgroundTest extends TestCase
{

    /**
     * Test for getCommandName()
     */
    public function testGetCommandName()
    {
        $cmd = new Multibackground();
        $result = $cmd->getCommandName();

        $this->assertIsString($result);
        $this->assertEquals('multibackground', $result);
    }

}