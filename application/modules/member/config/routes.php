<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route['admin/member']                  = 'member';
$route['admin/member/create']           = 'member/create';
$route['admin/member/update/(:num)']    = 'member/update/$1';
$route['admin/member/read/(:num)']      = 'member/read/$1';
$route['admin/member/delete/(:num)']    = 'member/delete/$1';
$route['admin/member/create_action']    = 'member/create_action';
$route['admin/member/update_action']    = 'member/update_action';
$route['admin/member/delete_action/(:num)']    = 'member/delete_action/$1';
$route['admin/member/tax/(:num)']    = 'member/tax/$1';
$route['admin/member/update_tax_action']    = 'member/update_tax_action';
