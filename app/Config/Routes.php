<?php

namespace Config;

use App\Controllers\UsernameValidator;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Pages::index');

$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);

$routes->group('user', function ($routes) {
	$routes->match(['get', 'post'], 'login', 'Users::login', ['filter' => 'noauth']);
	$routes->match(['get', 'post'], 'register', 'Users::register', ['filter' => 'noauth']);
	$routes->get('logout', 'Users::logout');
	$routes->get('verify/(:any)', 'Users::verifyUser/$1');
});

$routes->group('validation', function ($routes) {
	$routes->post('username_check', 'Validator::username_check');
	$routes->post('email_check', 'Validator::email_check');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
