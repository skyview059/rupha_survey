<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_helper {

    public static function makeTab( $active_tab = '' ){
        
        $html   = '<ul class="tabsmenu">';
        $tabs['#']          = '<i class="fa fa-user"></i> &nbsp;My Profile';
        $tabs['password']   = '<i class="fa fa-random"></i> &nbsp;Change Password';
                
        foreach( $tabs as $link=>$tab ){
            $html .= '<li><a href="'.  Backend_URL . 'profile/' . $link .'"';
            $html .= ($link  == $active_tab ) ? ' class="active"' : '';
            $html .= '> '. $tab .'</a></li>';
        }
        
        $html .= '</ul>';
        return $html;
    }
}    