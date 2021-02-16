<?php

namespace Tests\Commands;

use MinuteMan\PdftkClient\Commands\Rotate;
use PHPUnit\Framework\TestCase;

class RotateTest extends TestCase
{

    /**
     * Test  for __construct with the default arguments.
     */
    public function testConstructDefaultArgs()
    {
        $cmd = new Rotate();

        $this->assertEquals(0, $cmd->getRotation());
        $this->assertEquals(0, $cmd->getStartPage());
        $this->assertNull($cmd->getEndPage());
        $this->assertNull($cmd->getQualifier());
    }

    /**
     * Test  for __construct with provided arguments.
     */
    public function testConstructProvidedArgs()
    {
        $cmd = new Rotate(90, 3, 4, 'even');

        $this->assertEquals(90, $cmd->getRotation());
        $this->assertEquals(3, $cmd->getStartPage());
        $this->assertEquals(4, $cmd->getEndPage());
        $this->assertEquals('even', $cmd->getQualifier());
    }

    /**
     * Test for getRotation()
     */
    public function testGetRotation()
    {
        $cmd = new Rotate(90, 3, 4, 'even');
        $result = $cmd->getRotation();

        $this->assertIsInt($result);
        $this->assertEquals(90, $result);
    }

    /**
     * Test for getRotation() where the rotation is less than the lower bound.
     */
    public function testSetRotationLowerBound()
    {
        $defaultRotation = 90;
        $cmd = new Rotate($defaultRotation, 3, 4, 'even');
        $cmd->setRotation(-300);
        $result = $cmd->getRotation();

        $this->assertIsInt($result);
        $this->assertEquals($defaultRotation, $result);
    }

    /**
     * Test for getRotation() where the rotation is greater than the upper bound.
     */
    public function testSetRotationUpperBound()
    {
        $defaultRotation = 90;
        $cmd = new Rotate($defaultRotation, 3, 4, 'even');
        $cmd->setRotation(300);
        $result = $cmd->getRotation();

        $this->assertIsInt($result);
        $this->assertEquals($defaultRotation, $result);
    }

    /**
     * Test for getRotation() where the rotation is not a multiple of 90.
     */
    public function testSetRotationNotMultipleOf90()
    {
        $defaultRotation = 90;
        $cmd = new Rotate($defaultRotation, 3, 4, 'even');
        $cmd->setRotation(55);
        $result = $cmd->getRotation();

        $this->assertIsInt($result);
        $this->assertEquals($defaultRotation, $result);
    }

    /**
     * Test for getRotation() where the rotation is an accepted value.
     */
    public function testSetRotationAcceptedValue()
    {
        $defaultRotation = 90;
        $cmd = new Rotate($defaultRotation, 3, 4, 'even');
        $cmd->setRotation(180);
        $result = $cmd->getRotation();

        $this->assertIsInt($result);
        $this->assertEquals(180, $result);
    }

    /**
     * Test for getStartPage()
     */
    public function testGetStartPage()
    {
        $cmd = new Rotate(90, 3, 4, 'even');
        $result = $cmd->getStartPage();

        $this->assertIsInt($result);
    }

    /**
     * Test for setStartPage() where the page number is less than the lower bound.
     */
    public function testSetStartPageLowerBound()
    {
        $defaultStartPage = 3;
        $cmd = new Rotate(90, $defaultStartPage, 4, 'even');
        $cmd->setStartPage(-1);
        $result = $cmd->getStartPage();

        $this->assertEquals($defaultStartPage, $result);
    }

    /**
     * Test for setStartPage() where the page number is an accepted value.
     */
    public function testSetStartPageAcceptedValue()
    {
        $defaultStartPage = 3;
        $cmd = new Rotate(90, $defaultStartPage, 4, 'even');
        $cmd->setStartPage(180);
        $result = $cmd->getStartPage();

        $this->assertEquals(180, $result);
    }

    /**
     * Test for getEndPage()
     */
    public function testGetEndPage()
    {
        $cmd = new Rotate(90, 3, 4, 'even');
        $result = $cmd->getEndPage();

        $this->assertIsInt($result);
    }

    /**
     * Test for setEndPage() where the page number is a negative number.
     */
    public function testSetEndPageLowerBound()
    {
        $defaultEndPage = 3;
        $cmd = new Rotate(90, 0, $defaultEndPage, 'even');
        $cmd->setEndPage(-1);
        $result = $cmd->getEndPage();

        $this->assertEquals($defaultEndPage, $result);
    }

    /**
     * Test for setEndPage() where the page number is null.
     */
    public function testSetEndPageNull()
    {
        $defaultEndPage = 3;
        $cmd = new Rotate(90, 0, $defaultEndPage, 'even');
        $cmd->setEndPage(null);
        $result = $cmd->getEndPage();

        $this->assertNull($result);
    }

    /**
     * Test for setEndPage() where the page number is an accepted value.
     */
    public function testSetEndPageAcceptedValue()
    {
        $defaultEndPage = 3;
        $cmd = new Rotate(90, 0, $defaultEndPage, 'even');
        $cmd->setEndPage(15);
        $result = $cmd->getEndPage();

        $this->assertEquals(15, $result);
    }

    /**
     * Test for setQualifier()
     */
    public function testGetQualifier()
    {
        $cmd = new Rotate(90, 3, 4, 'even');
        $result = $cmd->getQualifier();

        $this->assertIsString($result);
    }

    /**
     * Test for setQualifier() where the qualifier is not valid.
     */
    public function testSetQualifierInvalid()
    {
        $defaultQualifier = 'even';
        $cmd = new Rotate(90, 3, 4, $defaultQualifier);
        $cmd->setQualifier('unknown');
        $result = $cmd->getQualifier();

        $this->assertNull($result);
    }

    /**
     * Test for setQualifier() where the qualifier is 'even'
     */
    public function testSetQualifierEven()
    {
        $defaultQualifier = 'even';
        $cmd = new Rotate(90, 3, 4, $defaultQualifier);
        $cmd->setQualifier('even');
        $result = $cmd->getQualifier();

        $this->assertEquals(Rotate::QUALIFIER_EVEN, $result);
    }

    /**
     * Test for setQualifier() where the qualifier is 'odd'
     */
    public function testSetQualifierOdd()
    {
        $defaultQualifier = 'even';
        $cmd = new Rotate(90, 3, 4, $defaultQualifier);
        $cmd->setQualifier('odd');
        $result = $cmd->getQualifier();

        $this->assertEquals(Rotate::QUALIFIER_ODD, $result);
    }

    /**
     * Test for setQualifier() where the qualifier is null
     */
    public function testSetQualifierNull()
    {
        $defaultQualifier = 'even';
        $cmd = new Rotate(90, 3, 4, $defaultQualifier);
        $cmd->setQualifier(null);
        $result = $cmd->getQualifier();

        $this->assertNull($result);
    }

    /**
     * Test for getCommandName()
     */
    public function testGetCommandName()
    {
        $cmd = new Rotate();
        $result = $cmd->getCommandName();

        $this->assertIsString($result);
        $this->assertEquals('rotate', $result);
    }

    /**
     * Test for getParams()
     */
    public function testGetParams()
    {
        $cmd = new Rotate();
        $result = $cmd->getParams();

        $this->assertIsArray($result);
        $this->assertEquals(
            [
                'rotation' => 0,
                'start'    => 0,
            ],
            $result
        );
    }

}