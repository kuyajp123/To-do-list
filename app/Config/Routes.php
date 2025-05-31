<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// View Routes
$routes->group('', ['filter' => 'guest'], function ($routes) {
    $routes->get('login', 'Auth::login');
    $routes->get('register', 'Auth::register');
});
$routes->get('/', 'Home::index');
$routes->get('dashboard', 'Auth::dashboard', ['filter' => 'auth']);
$routes->get('tasks', 'Auth::tasks', ['filter' => 'auth']);


// Auth Routes
$routes->post('register/save', 'Auth::saveRegister');
$routes->post('loginUser', 'Auth::loginUser');
$routes->get('logout', 'Auth::logout');
