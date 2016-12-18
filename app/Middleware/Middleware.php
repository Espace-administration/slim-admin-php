<?php

namespace App\Middleware;

/**
 * Class Middleware
 * @package App\Middleware
 */
class Middleware {
    /**
     * @var
     */
    protected $container;

    /**
     * @param $container
     */
    public function __construct($container) {
        $this->container = $container;
    }
}