<?php


namespace Tests;

use MinuteMan\PdftkClient\PdftkFlag;
use PHPUnit\Framework\TestCase;

/**
 * Class PdftkFlagTest
 *
 * @package Tests
 */
class PdftkFlagTest extends TestCase
{

    /**
     * Test for hasExclusions where the flag has no exclusions
     */
    public function testHasExclusionsNone()
    {
        $flag = PdftkFlag::DROP_XFA();
        $result = $flag->hasExclusions();

        $this->assertIsBool($result);
        $this->assertFalse($result);
    }

    /**
     * Test for hasExclusions where the flag has exclusions
     */
    public function testHasExclusions()
    {
        $flag = PdftkFlag::ENCRYPT_40BIT();
        $result = $flag->hasExclusions();

        $this->assertIsBool($result);
        $this->assertTrue($result);
    }

    /**
     * Test for getExclusions where the flag has no exclusions
     */
    public function testGetExclusionsNone()
    {
        $flag = PdftkFlag::DROP_XFA();
        $result = $flag->getExclusions();

        $this->assertIsArray($result);
        $this->assertEmpty($result);
    }

    /**
     * Test for getExclusions where the flag has exclusions
     */
    public function testGetExclusions()
    {
        $flag = PdftkFlag::ENCRYPT_40BIT();
        $result = $flag->getExclusions();

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

}