<?php

namespace Tests\Commands;

use MinuteMan\PdftkClient\Commands\FillForm;
use PHPUnit\Framework\TestCase;

/**
 * Class FillFormTest
 *
 * @package Tests\Commands
 */
class FillFormTest extends TestCase
{

    /**
     * Test for __construct() where default arguments are used.
     */
    public function testConstructDefaultArgs()
    {
        $cmd = new FillForm();

        $this->assertIsArray($cmd->getFieldData());
        $this->assertEmpty($cmd->getFieldData());
    }

    /**
     * Test for __construct where the arguments are provided.
     */
    public function testConstructProvidedArgs()
    {
        $fieldData = [
            'one' => 1,
            'two' => 2,
        ];
        $cmd = new FillForm($fieldData);

        $this->assertEquals($fieldData, $cmd->getFieldData());
    }

    /**
     * Test for setField()
     */
    public function testSetField()
    {
        $cmd = new FillForm();
        $cmd->setField('name', 'john');

        $this->assertEquals('john', $cmd->getField('name'));
    }

    /**
     * Test for hasField() where the field exists.
     */
    public function testHasFieldTrue()
    {
        $fieldData = [
            'one' => 1,
            'two' => 2,
        ];
        $cmd = new FillForm($fieldData);
        $result = $cmd->hasField('one');

        $this->assertTrue($result);
    }

    /**
     * Test for hasField() where the field does not exist.
     */
    public function testHasFieldFalse()
    {
        $fieldData = [
            'one' => 1,
            'two' => 2,
        ];
        $cmd = new FillForm($fieldData);
        $result = $cmd->hasField('three');

        $this->assertFalse($result);
    }

    /**
     * Test for getField() where the field exists.
     */
    public function testGetFieldExists()
    {
        $cmd = new FillForm();
        $cmd->setField('name', 'john');

        $this->assertEquals('john', $cmd->getField('name'));
    }

    /**
     * Test for getField() where the field does not exist.
     */
    public function testGetFieldNonexistent()
    {
        $cmd = new FillForm();
        $cmd->setField('name', 'john');

        $this->assertNull($cmd->getField('age'));
    }

    /**
     * Test for unsetField() where the field exists.
     */
    public function testUnsetFieldExists()
    {
        $fieldData = [
            'one' => 1,
            'two' => 2,
        ];
        $cmd = new FillForm($fieldData);
        $cmd->setFieldData($fieldData);
        $cmd->unsetField('one');

        $this->assertNotEquals($fieldData, $cmd->getFieldData());
        $this->assertFalse($cmd->hasField('one'));
        $this->assertTrue($cmd->hasField('two'));
    }

    /**
     * Test for unsetField() where the field does not exist.
     */
    public function testUnsetFieldNonexistent()
    {
        $fieldData = [
            'one' => 1,
            'two' => 2,
        ];
        $cmd = new FillForm($fieldData);
        $cmd->unsetField('three');

        $this->assertEquals($fieldData, $cmd->getFieldData());
    }

    /**
     * Test for getFieldData()
     */
    public function testGetFieldData()
    {
        $cmd = new FillForm();
        $result = $cmd->getFieldData();

        $this->assertIsArray($result);
    }

    /**
     * Test for setFieldData()
     */
    public function testSetFieldData()
    {
        $fieldData = [
            'one' => 1,
            'two' => 2,
        ];
        $cmd = new FillForm();
        $cmd->setFieldData($fieldData);

        $this->assertEquals($fieldData, $cmd->getFieldData());
    }

    /**
     * Test for getCommandName()
     */
    public function testGetCommandName()
    {
        $cmd = new FillForm();
        $result = $cmd->getCommandName();

        $this->assertIsString($result);
        $this->assertEquals('fill_form', $result);
    }

    /**
     * Test for getParams()
     */
    public function testGetParams()
    {
        $fieldData = [
            'one' => 1,
            'two' => 2,
        ];
        $cmd = new FillForm($fieldData);
        $result = $cmd->getParams();

        $this->assertIsArray($result);
        $this->assertEquals($fieldData, $result);
    }

}