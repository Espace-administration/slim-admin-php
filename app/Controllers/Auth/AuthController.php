<?php

namespace App\Controllers\Auth;

use App\Models\User;
use App\Controllers\Controller;
use Respect\Validation\Validator as v;

/**
 * Class AuthController
 * @package App\Controllers\Auth
 */
class AuthController extends Controller{
    /**
     * @param $request
     * @param $response
     * @return mixed
     */
    public function getSignOut($request, $response) {
        $this->auth->logout();
        return $response->withRedirect($this->router->pathFor('home'));
    }

    /**
     * @param $request
     * @param $response
     * @return mixed
     */
    public function getSignIn($request, $response) {
        return $this->view->render($response, 'auth/signin.twig');
    }

    /**
     * @param $request
     * @param $response
     * @return mixed
     */
    public function postSignIn($request, $response) {
        $auth = $this->auth->attempt(
            $request->getParam('email'),
            $request->getParam('password')
        );

        if (!$auth) {
            $this->flash->addMessage('error', 'Could not sign you with those details !');
            return $response->withRedirect($this->router->pathFor('auth.signin'));
        }

        return $response->withRedirect($this->router->pathFor('home'));
    }

    /**
     * @param $request
     * @param $response
     * @return mixed
     */
    public function getSignUp($request, $response) {
        return $this->view->render($response, 'auth/signup.twig');
    }

    /**
     * @param $request
     * @param $response
     * @return mixed
     */
    public function postSignUp($request, $response) {
        $validation = $this->validator->validate($request, [
            'email' => v::noWhitespace()->notEmpty()->email()->emailAvailable(),
            'name' => v::notEmpty()->alpha(),
            'password' => v::noWhitespace()->notEmpty(),
        ]);

        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor('auth.signup'));
        }

        $user = User::create([
            'email' => $request->getParam('email'),
            'name' => $request->getParam('name'),
            'password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
        ]);

        $this->flash->addMessage('info', 'You have been signed up !');
        $this->auth->attempt($user->email, $request->getParam('password'));

        return $response->withRedirect($this->router->pathFor('home'));
    }
}
