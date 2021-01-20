<?php

namespace MinuteMan\PdftkClient\Commands;

use MinuteMan\PdftkClient\PdfSources\PdfSource;

/**
 * Class Stamp
 *
 * @package MinuteMan\PdftkClient\Commands
 */
class Stamp extends Command
{

    /**
     * The PDF to use for the command.
     *
     * @var PdfSource
     */
    protected PdfSource $sourcePdf;

    /**
     * Multistamp constructor.
     *
     * @param PdfSource|null $sourcePdf
     */
    public function __construct(?PdfSource $sourcePdf = null)
    {
        if ($sourcePdf instanceof PdfSource) {
            $this->setSourcePdf($sourcePdf);
        }
    }

    /**
     * @return PdfSource
     */
    public function getSourcePdf(): PdfSource
    {
        return $this->sourcePdf;
    }

    /**
     * Set the PdfSource instance to use for the command.
     *
     * @param PdfSource $sourcePdf
     * @return $this
     */
    public function setSourcePdf(PdfSource $sourcePdf): self
    {
        $this->sourcePdf = $sourcePdf;

        return $this;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return [
            $this->getSourcePdf()->getParamName() => $this->getSourcePdf()->getParamValue(),
        ];
    }

    /**
     * @return string
     */
    public function getCommandName(): string
    {
        return 'stamp';
    }

}