<?php 

$string = "<?php defined('BASEPATH') OR exit('No direct script access allowed');

\$route['admin/$module_name']                  = '$module_name';
\$route['admin/$module_name/create']           = '$module_name/create';
\$route['admin/$module_name/update/(:num)']    = '$module_name/update/$1';
\$route['admin/$module_name/read/(:num)']      = '$module_name/read/$1';
\$route['admin/$module_name/delete/(:num)']    = '$module_name/delete/$1';
\$route['admin/$module_name/create_action']    = '$module_name/create_action';
\$route['admin/$module_name/update_action']    = '$module_name/update_action';
\$route['admin/$module_name/delete_action/(:num)']    = '$module_name/delete_action/$1';
";


$hasil_config_routes = createFile($string, $target."config/routes.php");

