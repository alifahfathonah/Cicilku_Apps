<?php

namespace Config;

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
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Auth::index', ['filter' => 'auth']);

//auth route
$routes->get('/auth', 'Auth::index', ['filter' => 'auth']);
$routes->get('/register', 'Auth::register', ['filter' => 'auth']);
$routes->get('/logout', 'Auth::logout');

//admin route
$routes->get('/admin', 'Admin::index', ['filter' => 'access']);

//menu route
$routes->get('/menu', 'Menu::index', ['filter' => 'access']);
$routes->post('/admin/user-menu/save', 'Menu::save', ['filter' => 'access']);
$routes->post('/admin/user-menu/update', 'Menu::update', ['filter' => 'access']);
$routes->post('/admin/user-menu/delete', 'Menu::delete', ['filter' => 'access']);

//users route
$routes->get('/admin/users', 'Users::index', ['filter' => 'access']);
$routes->post('/admin/users/save', 'Users::save', ['filter' => 'access']);
$routes->post('/admin/users/update', 'Users::update', ['filter' => 'access']);
$routes->post('/admin/users/delete', 'Users::delete', ['filter' => 'access']);


//submenu route
$routes->get('/menu/submenu', 'Menu::indexSubMenu', ['filter' => 'access']);
$routes->get('/menu/submenu/add', 'Menu::saveSubMenu', ['filter' => 'access']);
$routes->post('/menu/submenu/save', 'Menu::saveSubMenu', ['filter' => 'access']);
$routes->get('/menu/submenu/edit', 'Menu::EditSubMenu', ['filter' => 'access']);
$routes->post('/menu/submenu/edit', 'Menu::EditSubMenu', ['filter' => 'access']);
$routes->post('/menu/submenu/delete', 'Menu::deleteSubMenu', ['filter' => 'access']);

//role access route
$routes->get('/role', 'Role::index', ['filter' => 'access']);
$routes->post('/role/changeaccess', 'Role::changeaccess', ['filter' => 'access']);
$routes->post('/role/unlockaccess', 'Role::unlock', ['filter' => 'access']);


//
$routes->get('/op', 'Operator::index', ['filter' => 'access']);

//semester-man route
$routes->get('/semester', 'Semester::index', ['filter' => 'access']);
$routes->post('/semester/save', 'Semester::save', ['filter' => 'access']);
$routes->post('/semester/edit', 'Semester::edit', ['filter' => 'access']);
$routes->post('/semester/update', 'Semester::update', ['filter' => 'access']);
$routes->post('/semester/delete', 'Semester::delete', ['filter' => 'access']);

//guru-man route
$routes->get('/teachers', 'Teacher::index', ['filter' => 'access']);
$routes->get('/teachers/(:any)/edit', 'Teacher::update/$1', ['filter' => 'access']);
$routes->post('/teachers/update', 'Teacher::update', ['filter' => 'access']);
$routes->post('/teachers/changepassword', 'Teacher::changepassword', ['filter' => 'access']);
$routes->get('/teachers/add', 'Teacher::add', ['filter' => 'access']);
$routes->post('/teachers/save', 'Teacher::save', ['filter' => 'access']);
$routes->post('/teachers/delete', 'Teacher::delete', ['filter' => 'access']);


//kelas-man route
$routes->get('/class', 'Kelas::index', ['filter' => 'access']);
$routes->get('/class/semester/(:any)', 'Kelas::index/$1', ['filter' => 'access']);
$routes->get('/class/(:any)/add', 'Kelas::add/$1', ['filter' => 'access']);
$routes->get('/class/(:any)/(:any)/edit', 'Kelas::update/$1/$2', ['filter' => 'access']);
$routes->post('/class/update', 'Kelas::update', ['filter' => 'access']);
$routes->post('/class/save', 'Kelas::save', ['filter' => 'access']);
$routes->post('/class/delete', 'Kelas::delete', ['filter' => 'access']);

//guru-dash route
$routes->get('/tc', 'Guru::index', ['filter' => 'access']);



//siswa-dash route
$routes->get('/st', 'Siswa::index', ['filter' => 'access']);
// $routes->get('/(:any)', 'Auth::index', ['filter' => 'access']);



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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
