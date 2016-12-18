<?php

namespace App\Controllers\Auth;

use App\Models\User;
use App\Controllers\Controller;
use Respect\Validation\Validator as v;

/**
 * Class PasswordController
 * @package App\Controllers\Auth
 */
class PasswordController extends Controller{
    /**
     * @function getChangePassword
     * @param $request
     * @param $response
     * @return mixed
     * Permet de changer le password d'un utilisateur
     */
    public function getChangePassword($request, $response) {
        return $this->view->render($response, 'auth/password/change.twig');
    }

    /**
     * @function postChangePassword
     * @param $request
     * @param $response
     * @return mixed
     * vérifie les champs du formulaire
     */
    public function postChangePassword($request, $response) {
        $validation = $this->validator->validate($request, [
            'password_old' => v::noWhitespace()->notEmpty()->matchesPassword($this->auth->user()->password),
            'password' => v::noWhitespace()->notEmpty(),
        ]);

        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor('auth.password.change'));
        }

        $this->auth->user()->setPassword($request->getParam('password'));

        $this->flash->addMessage('info', 'Your password was changed.');

        return $response->withRedirect($this->router->pathFor('home'));
    }
}
