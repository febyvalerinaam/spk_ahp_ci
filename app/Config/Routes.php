<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
//$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/', 'Home::index');
$routes->get('/', 'Login::index');
$routes->post('/', 'Login::index');
$routes->post('/Login/login', 'Login::login');
$routes->get('/home', 'Login::home');


$routes->get('/logout', 'Login::logout');

$routes->get('Kriteria', 'Kriteria::index');
$routes->get('Kriteria/destroy/(:num)', 'Kriteria::destroy/$1');
$routes->get('Kriteria/edit/(:num)', 'Kriteria::edit/$1');
$routes->post('Kriteria/update/(:num)', 'Kriteria::update/$1');
$routes->get('Kriteria/gethtml', 'Kriteria::gethtml');
$routes->post('Kriteria/store', 'Kriteria::store');
$routes->get('Kriteria/create', 'Kriteria::create');
$routes->get('Kriteria/updateutama', 'Kriteria::updateutama');

$routes->get('Kategori','Kategori::index');
$routes->get('Kategori/create','Kategori::create');
$routes->post('Kategori/store','Kategori::store');
$routes->get('Kategori/destroy/(:num)','Kategori::destroy/$1');
$routes->get('Kategori/edit/(:num)','Kategori::edit/$1');
$routes->post('Kategori/update/(:num)','Kategori::update/$1');

$routes->get('Sub_Kriteria', 'SubKriteria::index');
$routes->post('Sub_kriteria/update/(:num)', 'SubKriteria::update/$1');
$routes->get('Sub_kriteria/destroy/(:num)', 'SubKriteria::destroy/$1');
$routes->post('Sub_kriteria/store', 'SubKriteria::store');
$routes->get('Sub_kriteria/getsubcontainer', 'SubKriteria::getsubcontainer');
$routes->get('Sub_kriteria/getsub', 'SubKriteria::getsub');

$routes->get('Alternatif', 'Alternatif::index');
$routes->get('Alternatif/create', 'Alternatif::create');
$routes->post('Alternatif/store', 'Alternatif::store');
$routes->get('Alternatif/edit/(:num)', 'Alternatif::edit/$1');
$routes->post('Alternatif/update/(:num)', 'Alternatif::update/$1');
$routes->get('Alternatif/destroy/(:num)', 'Alternatif::destroy/$1');

$routes->get('Penilaian','Penilaian::index');
$routes->post('Penilaian/update_penilaian','Penilaian::update_penilaian');

$routes->get('Perhitungan', 'Perhitungan::index');
$routes->get('Perhitungan/hasil', 'Perhitungan::hasil');

$routes->get('User', 'User::index');
$routes->get('User/create', 'User::create');
$routes->post('User/store', 'User::store');
$routes->get('User/show/(:num)', 'User::show/$1');
$routes->get('User/edit/(:num)', 'User::edit/$1');
$routes->get('User/destroy/(:num)', 'User::destroy/$1');
$routes->post('User/update/(:num)', 'User::update/$1');

$routes->get('Profile', 'Profile::index');
$routes->post('Profile/update/(:num)', 'Profile::update/$1');

$routes->get('Laporan', 'Laporan::index');
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
