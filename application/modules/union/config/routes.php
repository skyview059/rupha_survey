<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route['admin/union']                  = 'union';
$route['admin/union/create']           = 'union/create';
$route['admin/union/update/(:num)']    = 'union/update/$1';
$route['admin/union/read/(:num)']      = 'union/read/$1';
$route['admin/union/delete/(:num)']    = 'union/delete/$1';
$route['admin/union/create_action']    = 'union/create_action';
$route['admin/union/update_action']    = 'union/update_action';
$route['admin/union/delete_action/(:num)']    = 'union/delete_action/$1';
