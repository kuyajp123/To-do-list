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
$routes->get('schedule', 'Home::schedule', ['filter' => 'auth']);

// Auth Routes
$routes->post('register/save', 'Auth::saveRegister');
$routes->post('loginUser', 'Auth::loginUser');
$routes->get('logout', 'Auth::logout');

// Task Routes
$routes->post('tasks/save', 'TaskController::saveTask', ['filter' => 'auth']);
$routes->get('tasks', 'TaskController::getAllTasks', ['filter' => 'auth']);
$routes->get('get-todo-task/(:num)', 'TaskController::getTodoTask/$1', ['filter' => 'auth']);
$routes->post('update-todo-task', 'TaskController::updateTodoTask');
$routes->post('tasks/edit', 'TaskController::edit');
$routes->post('tasks/delete/(:num)', 'TaskController::deleteTask/$1');

// Calendar Routes
$routes->post('calendar/save-event', 'CalendarController::saveEvent');
$routes->get('calendar/get-events', 'CalendarController::getEvents');
$routes->put('calendar/update-event', 'CalendarController::updateEvent');
$routes->delete('calendar/delete-event/(:num)', 'CalendarController::deleteEvent/$1');
