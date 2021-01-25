<?php

namespace MinuteMan\PdftkClient\Commands;

/**
 * Class Rotate
 *
 * @package MinuteMan\PdftkClient\Commands
 */
class Rotate extends Command
{

    const QUALIFIER_EVEN = 'even';
    const QUALIFIER_ODD = 'odd';

    /**
     * Degrees to rotate each page. -270, -180, -90, 0, 90, 180, or 270.
     *
     * @var int
     */
    protected int $rotation = 0;

    /**
     * The starting page number of the range to be rotated.
     *
     * @var int
     */
    protected int $startPage = 0;

    /**
     * The ending page number of the range to be rotated.
     *
     * @var int|null
     */
    protected ?int $endPage = null;

    /**
     * Set to "even" or "odd" to have PDFtk only rotate those pages.
     *
     * @var string|null
     */
    protected ?string $qualifier = null;

    /**
     * Rotate constructor.
     *
     * @param int         $rotation
     * @param int         $startPage
     * @param int|null    $endPage
     * @param string|null $qualifier
     */
    public function __construct(int $rotation = 0, int $startPage = 0, ?int $endPage = null, ?string $qualifier = null)
    {
        $this->setRotation($rotation);
        $this->setStartPage($startPage);
        $this->setEndPage($endPage);
        $this->setQualifier($qualifier);
    }

    /**
     * Returns the degrees to rotate each page.
     *
     * @return int
     */
    public function getRotation(): int
    {
        return $this->rotation;
    }

    /**
     * Set the degrees to rotate each page. Valid options are -270, -180, -90, 0, 90, 180, or 270.
     *
     * @param int $rotation
     * @return $this
     */
    public function setRotation(int $rotation): self
    {
        if (($rotation % 90) === 0 && $rotation >= -270 && $rotation <= 270) {
            $this->rotation = $rotation;
        }

        return $this;
    }

    /**
     * Returns the starting page number of the range to be rotated.
     *
     * @return int
     */
    public function getStartPage(): int
    {
        return $this->startPage;
    }

    /**
     * Set the starting page number of the range to be rotated.
     * Value can non-negative integer.
     *
     * @param int
     * @return $this
     */
    public function setStartPage(int $startPage): self
    {
        if ($startPage >= 0) {
            $this->startPage = $startPage;
        }

        return $this;
    }

    /**
     * Returns the ending page number of the range to be rotated.
     *
     * @return int
     */
    public function getEndPage(): ?int
    {
        return $this->endPage;
    }

    /**
     * Set the ending page number of the range to be rotated.
     * Value can be null or non-negative integer.
     *
     * @param int|null
     * @return $this
     */
    public function setEndPage(?int $endPage): self
    {
        if (is_null($endPage) || $endPage >= 0) {
            $this->endPage = $endPage;
        }

        return $this;
    }

    /**
     * Returns the qualifier value for the rotation.
     *
     * @return string|null
     */
    public function getQualifier(): ?string
    {
        return $this->qualifier;
    }

    /**
     * Set the qualifier to "even", "odd", or null.
     *
     * @param string|null $qualifier
     * @return $this
     */
    public function setQualifier(?string $qualifier): self
    {
        if (strtolower($qualifier) === self::QUALIFIER_EVEN) {
            $this->qualifier = self::QUALIFIER_EVEN;
        } else {
            if (strtolower($qualifier) === self::QUALIFIER_ODD) {
                $this->qualifier = self::QUALIFIER_ODD;
            } else {
                $this->qualifier = null;
            }
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getCommandName(): string
    {
        return 'rotate';
    }

    /**
     * Return the parameter names and values in an associative array.
     *
     * @return array
     */
    public function getParams(): array
    {
        $params = [
            'rotation' => $this->getRotation(),
            'start'    => $this->getStartPage(),
        ];

        // Only include the end page if it is set to a non-null value.
        if (!is_null($this->getEndPage())) {
            $params['end'] = $this->getEndPage();
        }

        // Only include the qualifier if it is set to a non-null value.
        if (!is_null($this->getQualifier())) {
            $params['qualifier'] = $this->getQualifier();
        }

        return $params;
    }

}