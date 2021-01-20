<?php

namespace MinuteMan\PdftkClient;

use Konekt\Enum\Enum;

/**
 * Class PdftkOption
 *
 * @package MinuteMan\PdftkClient
 * @property bool $is_allow
 * @property bool $is_owner_pw
 * @property bool $is_user_pw
 * @method bool isAllow()
 * @method bool isOwnerPw()
 * @method bool isUserPw()
 * @method static self ALLOW()
 * @method static self OWNER_PW()
 * @method static self USER_PW()
 */
class PdftkOption extends Enum
{

    const ALLOW = 'allow';
    const OWNER_PW = 'owner_pw';
    const USER_PW = 'user_pw';

    /**
     * Array of "human-friendly" labels for each option.
     *
     * @var array|string[]
     */
    protected static array $labels = [
        self::ALLOW    => 'Allow',
        self::OWNER_PW => 'Owner Password',
        self::USER_PW  => 'User Password',
    ];

}