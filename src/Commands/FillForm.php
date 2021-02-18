<?php

namespace MinuteMan\PdftkClient\Commands;

/**
 * Class FillForm
 *
 * @package MinuteMan\PdftkClient\Commands
 */
class FillForm extends Command
{

    /**
     * Associative array of field names and their values.
     *
     * @var array
     */
    protected array $fieldData = [];

    /**
     * FillForm constructor.
     *
     * @param array $fieldData
     */
    public function __construct(array $fieldData = [])
    {
        $this->setFieldData($fieldData);
    }

    /**
     * Set the value of an individual field.
     *
     * @param string $fieldName
     * @param mixed  $fieldValue
     * @return $this
     */
    public function setField(string $fieldName, $fieldValue): self
    {
        $this->fieldData[$fieldName] = $fieldValue;

        return $this;
    }

    /**
     * Returns true if the field name provided exists in the field data array.
     *
     * @param string $fieldName
     * @return bool
     */
    public function hasField(string $fieldName): bool
    {
        return array_key_exists($fieldName, $this->fieldData);
    }

    /**
     * Returns the value of an individual field.
     *
     * @param string $fieldName
     * @return mixed
     */
    public function getField(string $fieldName)
    {
        if ($this->hasField($fieldName)) {
            return $this->fieldData[$fieldName];
        } else {
            return null;
        }
    }

    /**
     * Remove an individual field from the array of data.
     *
     * @param string $fieldName
     * @return $this
     */
    public function unsetField(string $fieldName): self
    {
        if ($this->hasField($fieldName)) {
            unset($this->fieldData[$fieldName]);
        }

        return $this;
    }

    /**
     * Returns all of the field names and their values.
     *
     * @return array
     */
    public function getFieldData(): array
    {
        return $this->fieldData;
    }

    /**
     * Set all of the field data at once.
     *
     * @param array $fieldData
     * @return $this
     */
    public function setFieldData(array $fieldData): self
    {
        $this->fieldData = $fieldData;

        return $this;
    }

    /**
     * @return string
     */
    public function getCommandName(): string
    {
        return 'fill_form';
    }

    /**
     * Returns all of the field names and their values to fill in a PDF form.
     *
     * @return array
     */
    public function getParams(): array
    {
        return $this->getFieldData();
    }

}