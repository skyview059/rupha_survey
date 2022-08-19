<?php 
$string = "<?php defined('BASEPATH') OR exit('No direct script access allowed');";

$string .= "\n\n" . 'function '.$c_url.'Tabs($id, $active_tab) {';
 
$string .= "\n\t$". "html = '<ul class=\"tabsmenu\">';";
$string .= "\n\t". '$tabs = [
                \'read\'   => \'Details\',        
                \'update\' => \'Update\',        
                \'delete\' => \'Delete\',
            ];';
    
$string .= "\n\n\t" . 'foreach ($tabs as $link => $tab) {';
$string .= "\n\t\t" . '$html .= \'<li> <a href="\' . Backend_URL .\''. $tab_link .'/\'. $link .\'/\'. $id .\'"\';';
//$string .= "\n\t\t" . '$html .= \'<li> <a href="\' . Backend_URL .\'/\'. $c_url .\'/\'. $link .\'/\'. $id .\'"\';';
$string .= "\n\t\t" . '$html .= ($link === $active_tab ) ? \' class="active"\' : \'\';';
$string .= "\n\t\t" . '$html .= \'> \' . $tab . \'</a></li>\';';
$string .= "\n\t}";
$string .= "\n\t" . '$html .= \'</ul>\';';
$string .= "\n\t" . 'return $html;';
$string .= "\n}";

$hasil_helper = createFile($string, $target.  "helpers/" . $h_file);