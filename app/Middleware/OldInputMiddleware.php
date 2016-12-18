<?php

namespace App\Middleware;

/**
 * Class OldInputMiddleware
 * @package App\Middleware
 */
class OldInputMiddleware extends Middleware {

    /**
     * @param $request
     * @param $response
     * @param $next
     * @return mixed
     */
    public function __invoke($request, $response, $next) {
        $old = isset($_SESSION['old']) ? $_SESSION['old'] : NULL;

        $this->container->view->getEnvironment()->addGlobal('old', $old);
        $_SESSION['old'] = $request->getParams();

        $response = $next($request, $response);
        return $response;
    }

}