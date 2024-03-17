<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Dashboard::index');
//route untuk admin
$routes->get('user_managamen', 'Admin\User_managamen', ['filter' => 'role:admin']);
$routes->get('user_managamen/detail/(:num)', 'Admin\User_managamen::detail/$1', ['filter' => 'role:admin']);
$routes->post('user_managamen/edit/(:num)', 'Admin\User_managamen::edit/$1', ['filter' => 'role:admin']);
$routes->get('user_managamen/delete/(:num)', 'Admin\User_managamen::delete/$1', ['filter' => 'role:admin']);
$routes->post('user_managamen/add', 'Admin\User_managamen::add', ['filter' => 'role:admin']);
$routes->get('user_managamen/add', 'Admin\User_managamen::add', ['filter' => 'role:admin']);

//route untuk user
$routes->get('my_profile', 'Dashboard::my_profile');
$routes->get('profile_setting', 'Dashboard::Profile_Setting');
$routes->post('profile_setting', 'Dashboard::Profile_Setting');


