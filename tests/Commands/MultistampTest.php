<?php

namespace Tests\Commands;

use MinuteMan\PdftkClient\Commands\Multistamp;
use PHPUnit\Framework\TestCase;

/**
 * Class MultistampTest
 *
 * @package Tests\Commands
 */
class MultistampTest extends TestCase
{

    /**
     * Test for getCommandName()
     */
    public function testGetCommandName()
    {
        $cmd = new Multistamp();
        $result = $cmd->getCommandName();

        $this->assertIsString($result);
        $this->assertEquals('multistamp', $result);
    }

}