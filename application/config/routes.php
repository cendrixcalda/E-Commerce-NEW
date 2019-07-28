<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['admin/editfeatured'] = 'admin/editfeatured';
$route['admin/usermanagement'] = 'admin/usermanagement';
$route['admin/inventory'] = 'admin/inventory';
$route['admin/dashboard'] = 'admin/dashboard';
$route['admin'] = 'admin/dashboard';

$route['shop/women'] = 'shop/women';
$route['shop/men'] = 'shop/men';
$route['shop/all'] = 'shop/all';
$route['shop'] = 'shop/all';

$route['default_controller'] = 'home';
// $route['(:any)'] = 'home/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
