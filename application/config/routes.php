<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// $route['brands'] = 'admin/dashboard';

// $route['users'] = 'admin/dashboard';

// $route['admin/sizes'] = 'admin/sizes';
// $route['admin/materials'] = 'admin/materials';
// $route['admin/countries'] = 'admin/countries';
// $route['admin/colors'] = 'admin/colors';
// $route['admin/categories'] = 'admin/categories';
// $route['admin/brands'] = 'admin/brands';
// $route['admin/archives'] = 'admin/archives';
// $route['admin/orders'] = 'admin/orders';
// $route['admin/usermanagement'] = 'admin/usermanagement';
// $route['admin/inventory'] = 'admin/inventory';
// $route['admin/dashboard'] = 'admin/dashboard';
// $route['admin/login'] = 'admin/login';
$route['admin'] = 'admin/dashboard';

$route['shop/women'] = 'shop/women';
$route['shop/men'] = 'shop/men';
$route['shop/all'] = 'shop/all';
$route['shop'] = 'shop/all';
$route['shop/(:any)'] = 'shop/view/$1';

$route['default_controller'] = 'home';
// $route['(:any)'] = 'home/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
