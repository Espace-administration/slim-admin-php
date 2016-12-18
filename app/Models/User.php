<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * @package App\Models
 */
class User extends Model {
    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * @var array
     */
    protected $fillable = [
        'email',
        'name',
        'password',
    ];

    /**
     * @param $password
     */
    public function setPassword($password) {
        $this->update([
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);
    }
}