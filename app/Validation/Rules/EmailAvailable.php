<?php

namespace App\Validation\Rules;

use App\Models\User;
use Respect\Validation\Rules\AbstractRule;

/**
 * Class EmailAvailable
 * @package App\Validation\Rules
 */
class EmailAvailable extends AbstractRule {
    /**
     * @param $input
     * @return bool
     */
    public function validate($input) {
        return User::where('email', $input)->count() === 0;
    }
}