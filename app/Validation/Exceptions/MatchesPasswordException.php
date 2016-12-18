<?php

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

/**
 * Class MatchesPasswordException
 * @package App\Validation\Exceptions
 */
class MatchesPasswordException extends ValidationException {
    /**
     * @var array
     */
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Password does not match.',
        ],
    ];
}