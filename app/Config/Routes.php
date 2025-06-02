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
$routes->get('dashboard', 'Home::dashboard', ['filter' => 'auth']);


// Auth Routes
$routes->post('register/save', 'Auth::saveRegister');
$routes->post('loginUser', 'Auth::loginUser');
$routes->get('logout', 'Auth::logout');

// API Routes
$routes->post('tasks/save', 'Home::saveTask', ['filter' => 'auth']);
$routes->get('tasks', 'Home::getAllTasks', ['filter' => 'auth']);
$routes->get('get-todo-task/(:num)', 'Home::getTodoTask/$1', ['filter' => 'auth']);
$routes->post('update-todo-task', 'Home::updateTodoTask');
