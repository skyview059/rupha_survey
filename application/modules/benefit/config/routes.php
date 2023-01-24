<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route['admin/benefit']                  = 'benefit';
$route['admin/benefit/create']           = 'benefit/create';
$route['admin/benefit/update/(:num)']    = 'benefit/update/$1';
$route['admin/benefit/create_action']    = 'benefit/create_action';
$route['admin/benefit/update_action']    = 'benefit/update_action';
$route['admin/benefit/delete/(:num)']    = 'benefit/delete/$1';
