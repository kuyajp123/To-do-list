<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('login', 'Auth::login');
$routes->get('register', 'Auth::register');
$routes->post('register/save', 'Auth::saveRegister');
$routes->post('loginUser', 'Auth::loginUser');
$routes->get('logout', 'Auth::logout');
$routes->get('profile', 'Auth::profile');
