<?php

$allowed = array(    
    '20-1A-06-FE-50-FB',    // 'KannyLenevo'
    '8C-16-45-39-FA-15',    // 'KannyLenevo'
    'E0-2A-82-47-54-E2',    // 'KannyLenevo'
    'F0-4D-A2-63-37-8B',    // 'TusherDell'   
	'40-8D-5C-78-38-C6',    // 'Shakhwat'
	'80-A5-89-B5-B3-D1',    // 'Saidur Rahaman'		
	'00-21-6A-A5-F0-C8',    // 'Kanny Dell / Sajid PC'		
	'30-8D-99-69-CB-DD',    // 'Kanny Dell / Sajid PC'		
);


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


function license_return(){
	return true;
}