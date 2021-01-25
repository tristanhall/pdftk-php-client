<?php

namespace MinuteMan\PdftkClient;

use BadMethodCallException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use InvalidArgumentException;
use JsonException;
use MinuteMan\PdftkClient\Commands\Command;
use MinuteMan\PdftkClient\PdfSources\PdfSource;
use Psr\Http\Message\ResponseInterface;

/**
 * Class PdftkDocument
 * An instance of a PDF that contains a source PDF, command, flags, and options that can be sent to the Pdftk
 * Microservice.
 *
 * @package MinuteMan\PdftkClient
 * @method self setInputPw()
 * @method self setEncrypt40bit()
 * @method self setEncrypt128bit()
 * @method self setFlatten()
 * @method self setNeedAppearances()
 * @method self setCompress()
 * @method self setUncompress()
 * @method self setKeepFirstId()
 * @method self setKeepFinalId()
 * @method self setDropXfa()
 * @method self setAllow($value)
 * @method self setOwnerPw($value)
 * @method self setUserPw($value)
 * @method self unsetInputPw()
 * @method self unsetEncrypt40bit()
 * @method self unsetEncrypt128bit()
 * @method self unsetFlatten()
 * @method self unsetNeedAppearances()
 * @method self unsetCompress()
 * @method self unsetUncompress()
 * @method self unsetKeepFirstId()
 * @method self unsetKeepFinalId()
 * @method self unsetDropXfa()
 * @method self unsetAllow()
 * @method self unsetOwnerPw()
 * @method self unsetUserPw()
 * @method mixed getAllow()
 * @method mixed getOwnerPw()
 * @method mixed getUserPw()
 */
class PdftkDocument
{

    /**
     * Instance of the ApiClient class to submit the PDF request.
     *
     * @var ApiClient
     */
    protected ApiClient $apiClient;

    /**
     * The PDF to manipulate.
     *
     * @var PdfSource
     */
    protected PdfSource $sourcePdf;

    /**
     * The command to perform on the source PDF.
     *
     * @var Command
     */
    protected Command $command;

    /**
     * @var array
     */
    protected array $flags = [];

    /**
     * @var array
     */
    protected array $options = [];

    /**
     * Pdftk constructor.
     *
     * @param ApiClient $apiClient
     */
    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * Override method calls to unknown functions to handle dynamic setting/unsetting of flags and options.
     *
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        // If a method call is received that starts with "set", try to determine if a flag or option is being adjusted
        if (substr($name, 0, 3) === 'set' && strlen($name) > 3) {
            $flagOptionName = strtoupper(Str::snake(substr($name, 3)));

            // Handle flags in the form of method calls to "setFlagNameHere()"
            if (PdftkFlag::hasConst($flagOptionName) && count($arguments) === 0) {
                return $this->addFlag(PdftkFlag::$flagOptionName());
            } else {
                if (PdftkOption::hasConst($flagOptionName) && count($arguments) > 0) {
                    $optionValue = Arr::first($arguments);

                    return $this->addOption(PdftkOption::$flagOptionName(), $optionValue);
                } else {
                    throw new BadMethodCallException(sprintf('Method %s::%s not found.', __CLASS__, $name));
                }
            }
        } else {
            // If a method call is received that starts with "unset", try to determine if a flag or option is being removed
            if (substr($name, 0, 5) === 'unset' && strlen($name) > 5) {
                $flagOptionName = strtoupper(Str::snake(substr($name, 5)));

                // Handle flags in the form of method calls to "unsetFlagNameHere()"
                if (PdftkFlag::hasConst($flagOptionName) && count($arguments) === 0) {
                    return $this->removeFlag(PdftkFlag::$flagOptionName());
                } else {
                    if (PdftkOption::hasConst($flagOptionName) && count($arguments) === 0) {
                        return $this->removeOption(PdftkOption::$flagOptionName());
                    } else {
                        throw new BadMethodCallException(sprintf('Method %s::%s not found.', __CLASS__, $name));
                    }
                }
            } else {
                // If a method call is received that starts with "set", try to determine if the value of an option can be returned
                if (substr($name, 0, 3) === 'get' && strlen($name) > 3) {
                    $optionName = strtoupper(Str::snake(substr($name, 3)));

                    // If the option exists, return the value. Null will be returned if the option is not yet configured.
                    if (PdftkOption::hasConst($optionName) && count($arguments) === 0) {
                        return Arr::get($this->options, sprintf('%s.value', PdftkOption::$optionName()->value()));
                    } else {
                        throw new BadMethodCallException(sprintf('Method %s::%s not found.', __CLASS__, $name));
                    }
                } else {
                    throw new BadMethodCallException(sprintf('Method %s::%s not found.', __CLASS__, $name));
                }
            }
        }
    }

    /**
     * Returns the instance of the ApiClient class assigned to this PDF.
     *
     * @return ApiClient
     */
    public function getApiClient(): ApiClient
    {
        return $this->apiClient;
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
     * Set the command to apply to the source PDF.
     *
     * @param Command $command
     * @return $this
     */
    public function setCommand(Command $command): self
    {
        $this->command = $command;

        return $this;
    }

    /**
     * @return Command
     */
    public function getCommand(): Command
    {
        return $this->command;
    }

    /**
     * Enable a flag.
     *
     * @param PdftkFlag $flag
     * @return $this
     */
    public function addFlag(PdftkFlag $flag): self
    {
        Arr::set($this->flags, $flag->value(), true);

        return $this;
    }

    /**
     * Disable a flag.
     *
     * @param PdftkFlag $flag
     * @return $this
     */
    public function removeFlag(PdftkFlag $flag): self
    {
        Arr::set($this->flags, $flag->value(), false);

        return $this;
    }

    /**
     * Returns an array of all the enabled flags.
     *
     * @return array
     */
    public function getFlags(): array
    {
        $flags = [];

        foreach ($this->flags as $flagName => $isEnabled) {
            if ($isEnabled) {
                array_push($flags, $flagName);
            }
        }

        return $flags;
    }

    /**
     * Add an option.
     *
     * @param PdftkOption $option
     * @param mixed       $value
     * @throws InvalidArgumentException
     * @return $this
     */
    public function addOption(PdftkOption $option, $value): self
    {
        if ($option->isValidValue($value)) {
            Arr::set($this->options, $option->value(), [
                'enabled' => true,
                'value'   => $value,
            ]);

            return $this;
        } else {
            throw new InvalidArgumentException(sprintf(
                'Invalid value "%s" provided for "%s"',
                (string)$value,
                $option->label()
            ));
        }
    }

    /**
     * Disable an option.
     *
     * @param PdftkOption $option
     * @return $this
     */
    public function removeOption(PdftkOption $option): self
    {
        Arr::set($this->options, $option->value(), [
            'enabled' => false,
            'value'   => null,
        ]);

        return $this;
    }

    /**
     * Returns a key-value associative array of all the enabled options and their values.
     *
     * @return array
     */
    public function getOptions(): array
    {
        $options = [];

        foreach ($this->options as $key => $params) {
            if ((bool)Arr::get($params, 'enabled', false) === true) {
                $options[$key] = Arr::get($params, 'value');
            }
        }

        return $options;
    }

    /**
     * Returns an array of data to provide in the body of the request to the API.
     *
     * @return array
     */
    protected function getParams(): array
    {
        $sourcePdf = $this->getSourcePdf();
        $command = $this->getCommand();

        if ($sourcePdf instanceof PdfSource) {
            if ($command instanceof Command) {
                return [
                    $sourcePdf->getParamName() => $sourcePdf->getParamValue(),
                    $command->getCommandName() => $command->getParams(),
                    'flags'                    => $this->getFlags(),
                    'options'                  => $this->getOptions(),
                ];
            } else {
                throw new InvalidArgumentException('No command provided.');
            }
        } else {
            throw new InvalidArgumentException('No Source PDF provided.');
        }
    }

    /**
     * Creates the API request and sends it. Returns a ResponseInterface object if a 200 status code is received.
     *
     * @throws GuzzleException|JsonException
     * @return ResponseInterface
     */
    protected function getApiResponse(): ResponseInterface
    {
        return $this->getApiClient()->sendRequest($this->getApiClient()->makeRequest($this->getParams()));
    }

    /**
     * Returns a stream resource of the API response with automatic Base64 decoding of the content.
     *
     * @throws JsonException|GuzzleException
     * @return resource|null
     */
    public function getStream()
    {
        $byteStream = $this->getApiResponse()->getBody()->detach();

        // Base64 decode the stream data
        stream_filter_append($byteStream, 'convert.base64-decode');

        return $byteStream;
    }

    /**
     * Request the PDF data and write the stream to a file.
     *
     * @param string $path
     * @throws JsonException|GuzzleException
     * @return bool
     */
    public function saveFile(string $path): bool
    {
        return (bool)file_put_contents($path, $this->getStream());
    }

}