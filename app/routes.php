<?php

use \App\Middleware\AuthMiddleware;
use \App\Middleware\GuestMiddleware;

//__ Visible Page for all
$app->get('/', 'HomeController:index')->setName('home');
$app->get('/home', 'HomeController:home')->setName('home_home');
$app->get('/contact', 'HomeController:contact')->setName('contact');

//__ Visible page when we're not connected
$app->group('', function() use ($app) {
    $this->get('/auth/signup','AuthController:getSignUp')->setName('auth.signup');
    $this->post('/auth/signup','AuthController:postSignUp');

    $this->get('/auth/signin','AuthController:getSignIn')->setName('auth.signin');
    $this->post('/auth/signin','AuthController:postSignIn');
})->add(new GuestMiddleware($container));

//__ Visible page when we're connected
$app->group('', function() use ($app) {
    $this->get('/auth/signout','AuthController:getSignOut')->setName('auth.signout');

    $this->get('/auth/password/change','PasswordController:getChangePassword')->setName('auth.password.change');
    $this->post('/auth/password/change','PasswordController:postChangePassword');
})->add(new AuthMiddleware($container));