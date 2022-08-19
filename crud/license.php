<?php

$allowed = array(    
    '20-1A-06-FE-50-FB',    // 'KannyLenevo'
    'F0-4D-A2-63-37-8B',    // 'TusherDell'   
	'40-8D-5C-78-38-C6',    // 'Shakhwat'
	'40-8D-5C-A1-A4-7E',    // 'AbdulBari'	
	'70-71-BC-18-F2-67',    // 'Imran'
);

/*
 * 
'20-1A-06-FE-50-FB',    // 'KannyHpMini'
'20-1A-06-FE-50-FB',    // 'KannyDell'
'20-1A-06-FE-50-FB',    // 'HomaunHp'
'20-1A-06-FE-50-FB'     // 'SazzadMahmud'
 */

function my_mac(){
    ob_start(); // Turn on output buffering
    system('ipconfig/all'); //Execute external program to display output
    $mycom	= ob_get_contents(); // Capture the output into a variable
    ob_clean(); // Clean (erase) the output buffer

    $findme     = 'Physical';
    $pmac 	= strpos($mycom, $findme); // Find the position of Physical text
    $mac	= substr($mycom,($pmac+36),17); // Get Physical Address
    return $mac;
}

$my_mac = my_mac();   

if( !in_array($my_mac, $allowed)){    
    $html = '<div style="color:red; text-align:center;">';
    $html .= '<h1>This computer is not allowed to run this script!</h1>';
	
    $html .= '<p>To get access this app contact to Kanny<br/><br/> Your Lisence Code: <b>' . $my_mac .'</b></p>';
    $html .= '</div>';
    die( $html );
}













