<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::login'); // Default login page
$routes->get('/logout', 'Home::logout');
$routes->get('/cus_logout', 'Home::customerlogout');
// $routes->get('/dashboard', 'Home::index'); // Dashboard
$routes->get('/dashboard', 'Home::index', ['filter' => 'role:admin']);
$routes->post('login', 'Login::login');
$routes->get('/userdetails', 'Home::index');
$routes->get('/fetchLeads/(:num)', 'Home::fetchLeads/$1'); // Accept page number as parameter
$routes->get('/getLeadDetails/(:num)', 'Home::getLeadDetails/$1');
$routes->get('register', 'Home::register');
$routes->get('warehouses', 'Home::getWarehouses');
// User registration form submission
$routes->post('register/save', 'Home::save');
$routes->get('warehouse_register', 'Home::warehouse_register');
$routes->get('warehouses', 'Home::getWarehouses');




// customer Login

$routes->get('/cus_login', 'Login::loginView');
$routes->post('/customerlogin', 'Login::customerlogin');
$routes->get('/customerlogout', 'Login::logout');


// customer Login close

// AJAX email/phone uniqueness check
$routes->post('register/checkUnique', 'Home::checkUnique');
// $routes->get('/employee', 'Allemployee::allemployee');
// $routes->get('allemployee/list', 'Allemployee::allemployee');
// $routes->get('allemployee', 'Allemployee::index');               // Show user list
// $routes->get('/allemployee/edit/(:num)', 'Allemployee::edit/$1');      // Show edit form
// $routes->post('/allemployee/update/(:num)', 'Allemployee::update/$1'); // Handle form submit
// $routes->post('/allemployee/delete', 'Allemployee::delete');           // Handle AJAX delete



$routes->get('allemployee', 'Allemployee::index', ['filter' => 'role:admin']);
$routes->get('/allemployee/edit/(:num)', 'Allemployee::edit/$1', ['filter' => 'role:admin']);
$routes->post('/allemployee/update/(:num)', 'Allemployee::update/$1', ['filter' => 'role:admin']);
$routes->post('/allemployee/delete', 'Allemployee::delete', ['filter' => 'role:admin']);

// barcode genrator


$routes->get('barcode', 'BarcodeController::index');
$routes->post('barcode/generate', 'BarcodeController::generate');
$routes->get('barcode/list', 'BarcodeController::list');



// ====================================================


// // Home pages 
$routes->get('/table', 'Home::table');
// $routes->get('/customers', 'Home::customers');
$routes->get('/customers', 'Home::customers', ['filter' => 'role:admin,manager']);

$routes->get('/upload_inventory', 'Home::upload_inventory');
// $routes->get('/inventorylist', 'Home::inventorylist');
// ✅ Inventory List — Only for admin and customer
$routes->get('/inventorylist', 'Home::inventorylist', ['filter' => 'role:admin,customer']);
$routes->get('/inventoryreport', 'Home::inventory_report', ['filter' => 'role:admin,customer']);

// ✅ Protect other sensitive pages if needed
$routes->get('/fetchLeads/(:num)', 'Home::fetchLeads/$1', ['filter' => 'role:admin']);
$routes->get('/getLeadDetails/(:num)', 'Home::getLeadDetails/$1', ['filter' => 'role:admin']);
