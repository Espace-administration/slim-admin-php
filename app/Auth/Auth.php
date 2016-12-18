<?php

namespace App\Auth;

use App\Models\User;

/**
 * Class Auth
 * @package App\Auth
 */
class Auth {
    /**
     * @function user
     * @return mixed
     * récupère les informations de session d'un utilisateur s'il est connecté
     */
    public function user(){
        $user = isset($_SESSION['user']) ? $_SESSION['user'] : NULL;

        return User::find($user);
    }

    /**
     * @function check
     * @return bool
     * check si la SESSION existe
     */
    public function check() {
        return isset($_SESSION['user']);
    }

    /**
     * @function attempt
     * @param $email
     * @param $password
     * @return bool
     * Connecte l'utilisateur si l'email et le password corresponde
     */
    public function attempt($email, $password) {
        $user = User::where('email', $email)->first();

        if(!$user){
            return false;
        }

        if (password_verify($password, $user->password)) {
            $_SESSION['user'] = $user->id;
            return true;
        }

        return false;
    }

    /**
     * @function logout
     * déconnecte l'utilisateur
     */
    public function logout(){
        unset($_SESSION['user']);
    }

}