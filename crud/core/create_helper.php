<?php 
$string = "<?php defined('BASEPATH') OR exit('No direct script access allowed');";

$string .= "\n\nfunction {$c_url}Tabs(\$id, \$active_tab) {";
 
$string .= "\n\t\$html = '<ul class=\"tabsmenu\">';";
$string .= "\n\t\$tabs = [
                'read'   => 'Details',
                'update' => 'Update',
                'delete' => 'Delete',
            ];";
    
$string .= "\n\n\tforeach (\$tabs as \$link=>\$tab) {";
$string .= "\n\t\t\$html .= '<li><a href=\"' . Backend_URL .\"{$tab_link}/{\$link}/{\$id}\\\"\";";
$string .= "\n\t\t\$html .= (\$link == \$active_tab ) ? ' class=\"active\"' : '';";
$string .= "\n\t\t\$html .= '>'. \$tab . '</a></li>';";
$string .= "\n\t}";
$string .= "\n\t\$html .= '</ul>';";
$string .= "\n\treturn \$html;";
$string .= "\n}";

$hasil_helper = createFile($string, $target.  "helpers/{$h_file}");