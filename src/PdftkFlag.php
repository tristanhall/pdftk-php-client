<?php

namespace MinuteMan\PdftkClient;

use Illuminate\Support\Arr;
use Konekt\Enum\Enum;

/**
 * Class PdftkFlag
 *
 * @package MinuteMan\PdftkClient
 * @property bool $is_input_pw
 * @property bool $is_encrypt_40bit
 * @property bool $is_encrypt_128bit
 * @property bool $is_flatten
 * @property bool $is_need_appearances
 * @property bool $is_compress
 * @property bool $is_uncompress
 * @property bool $keep_first_id
 * @property bool $keep_final_id
 * @property bool $drop_xfa
 * @method bool isInputPw()
 * @method bool isEncrypt40bit()
 * @method bool isEncrypt128bit()
 * @method bool isFlatten()
 * @method bool isNeedAppearances()
 * @method bool isCompress()
 * @method bool isUncompress()
 * @method bool isKeepFirstId()
 * @method bool isKeepFinalId()
 * @method bool isDropXfa()
 * @method static self INPUT_PW()
 * @method static self ENCRYPT_40BIT()
 * @method static self ENCRYPT_128BIT()
 * @method static self FLATTEN()
 * @method static self NEED_APPEARANCES()
 * @method static self COMPRESS()
 * @method static self UNCOMPRESS()
 * @method static self KEEP_FIRST_ID()
 * @method static self KEEP_FINAL_ID()
 * @method static self DROP_XFA()
 */
class PdftkFlag extends Enum
{

    const INPUT_PW = 'input_pw';
    const ENCRYPT_40BIT = 'encrypt_40bit';
    const ENCRYPT_128BIT = 'encrypt_128bit';
    const FLATTEN = 'flatten';
    const NEED_APPEARANCES = 'need_appearances';
    const COMPRESS = 'compress';
    const UNCOMPRESS = 'uncompress';
    const KEEP_FIRST_ID = 'keep_first_id';
    const KEEP_FINAL_ID = 'keep_final_id';
    const DROP_XFA = 'drop_xfa';

    /**
     * Array of flags that cannot be used with another flag.
     *
     * @var array
     */
    protected static array $exclusions = [
        self::ENCRYPT_40BIT  => [
            self::ENCRYPT_128BIT,
        ],
        self::ENCRYPT_128BIT => [
            self::ENCRYPT_40BIT,
        ],
        self::COMPRESS       => [
            self::UNCOMPRESS,
        ],
        self::UNCOMPRESS     => [
            self::COMPRESS,
        ],
        self::KEEP_FIRST_ID  => [
            self::KEEP_FINAL_ID,
        ],
        self::KEEP_FINAL_ID  => [
            self::KEEP_FIRST_ID,
        ],
    ];

    /**
     * Array of "human-friendly" labels for each flag.
     *
     * @var array|string[]
     */
    protected static array $labels = [
        self::INPUT_PW         => 'Input Password',
        self::ENCRYPT_40BIT    => 'Encrypt 40-bit',
        self::ENCRYPT_128BIT   => 'Encrypt 128-bit',
        self::FLATTEN          => 'Flatten',
        self::NEED_APPEARANCES => 'Need Appearances',
        self::COMPRESS         => 'Compress',
        self::UNCOMPRESS       => 'Uncompress',
        self::KEEP_FIRST_ID    => 'Keep First ID',
        self::KEEP_FINAL_ID    => 'Keep Final ID',
        self::DROP_XFA         => 'Drop XFA',
    ];

    /**
     * Returns true if the current flag has 1 or more excluded flags that cannot be used with it.
     *
     * @return bool
     */
    public function hasExclusions(): bool
    {
        return count($this->getExclusions()) > 0;
    }

    /**
     * Returns the array of flags that cannot be used with the current flag.
     *
     * @return array
     */
    public function getExclusions(): array
    {
        return Arr::wrap(Arr::get(self::$exclusions, $this->value(), []));
    }

}