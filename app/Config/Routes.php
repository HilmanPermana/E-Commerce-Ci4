<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
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
$routes->get('/', 'C_Auth::login');
$routes->get('/cart', 'C_Home::cart');
$routes->get('/checkout', 'C_Transaksi::checkout');


$routes->post('/add_to_cart', 'C_Transaksi::add_to_cart');
$routes->post('/delete_product_in_cart', 'C_Transaksi::delete_product_in_cart');
$routes->post('/update_qty_cart', 'C_Transaksi::update_qty_cart');
$routes->post('/checkout', 'C_Transaksi::checkout');
$routes->post('/auth/valid_register', 'C_Auth::valid_register');
$routes->post('/auth/valid_login', 'C_Auth::valid_login');

$routes->get('/admin/dashboard', 'C_Admin::index');
$routes->resource('admin/barang', ['controller' => 'C_Barang']);
$routes->get('/api/barang/(:num)', 'C_Barang::getBarang');
$routes->get('/api/barang', 'C_Barang::getBarang');
$routes->get('/product', 'C_Home::index');
$routes->get('/auth/logout', 'C_Auth::logout');
$routes->get('/auth/login', 'C_Auth::login');
$routes->get('/auth/register', 'C_Auth::register');
$routes->get('/user', 'C_User::index');
$routes->get('/update_qty_cart', 'C_Transaksi::update_qty_cart');


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
