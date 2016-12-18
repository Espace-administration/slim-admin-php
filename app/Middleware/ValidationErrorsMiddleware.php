<?php

namespace App\Middleware;

/**
 * Class ValidationErrorsMiddleware
 * @package App\Middleware
 */
class ValidationErrorsMiddleware extends Middleware {

    /**
     * @param $request
     * @param $response
     * @param $next
     * @return mixed
     */
    public function __invoke($request, $response, $next) {
        $errors =  isset($_SESSION['errors']) ? $_SESSION['errors'] : NULL;

        $this->container->view->getEnvironment()->addGlobal('errors', $errors);
        unset($_SESSION['errors']);

        $response = $next($request, $response);
        return $response;
    }

}