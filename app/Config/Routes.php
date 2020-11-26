<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
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
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->resource('restchat');
$routes->get('/', 'Home::index');
$routes->get('news/(:segment)', 'News::view/$1');
$routes->get('news', 'News::index');
$routes->match(['get', 'post'], 'login', 'Users::login');
$routes->match(['get', 'post'], 'register', 'Users::register');
$routes->get('users/(:segment)', 'Users::view/$1');
$routes->get('users', 'Users::index');
$routes->get('pages/(:segment)', 'Pages::view/$1');
$routes->get('chat', 'Chat::index');
$routes->get('admin', 'Admin::index');
$routes->get('logout', 'Users::logout');
$routes->get('activities/add', 'Activities::add');
$routes->get('activities/(:segment)', 'Activities::view/$1');
$routes->get('upcoming', 'Activities::index');
$routes->get('activities', 'Activities::allActivities');
$routes->get('profile', 'Users::profile');
$routes->get('posts', 'Posts::index');
$routes->get('edit', 'Users::edit');










/**
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
