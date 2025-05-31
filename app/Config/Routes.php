<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// View Routes
$routes->get('/', 'Home::index');
$routes->group('', ['filter' => 'guest'], function ($routes) {
    $routes->get('login', 'Auth::login');
    $routes->get('register', 'Auth::register');
});


// Auth Routes
$routes->post('register/save', 'Auth::saveRegister');
$routes->post('loginUser', 'Auth::loginUser');
$routes->get('logout', 'Auth::logout');
$routes->get('profile', 'Auth::profile', ['filter' => 'auth']);
