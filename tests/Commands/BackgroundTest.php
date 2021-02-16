<?php

namespace Tests\Commands;

use MinuteMan\PdftkClient\Commands\Background;
use PHPUnit\Framework\TestCase;

/**
 * Class BackgroundTest
 *
 * @package Tests\Commands
 */
class BackgroundTest extends TestCase
{

    /**
     * Test for getCommandName()
     */
    public function testGetCommandName()
    {
        $cmd = new Background();
        $result = $cmd->getCommandName();

        $this->assertIsString($result);
        $this->assertEquals('background', $result);
    }

}