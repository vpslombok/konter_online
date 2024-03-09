<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Dashboard::index');
$routes->get('user_managamen', 'Admin\User_managamen', ['filter' => 'role:admin']);
$routes->get('user_managamen/detail/(:num)', 'Admin\User_managamen::detail/$1', ['filter' => 'role:admin']);
$routes->get('profile_setting', 'Dashboard::Profile_Setting');

