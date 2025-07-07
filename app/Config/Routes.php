<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::login'); // Default login page
$routes->get('/logout', 'Home::logout');
$routes->get('/dashboard', 'Home::index'); // Dashboard
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


// AJAX email/phone uniqueness check
$routes->post('register/checkUnique', 'Home::checkUnique');
// $routes->get('/employee', 'Allemployee::allemployee');
// $routes->get('allemployee/list', 'Allemployee::allemployee');
$routes->get('allemployee', 'Allemployee::index');               // Show user list
$routes->get('/allemployee/edit/(:num)', 'Allemployee::edit/$1');      // Show edit form
$routes->post('/allemployee/update/(:num)', 'Allemployee::update/$1'); // Handle form submit
$routes->post('/allemployee/delete', 'Allemployee::delete');           // Handle AJAX delete







// // Home pages 
$routes->get('/table', 'Home::table');
$routes->get('/customers', 'Home::customers');
$routes->get('/upload_inventory', 'Home::upload_inventory');
$routes->get('/inventorylist', 'Home::inventorylist');
