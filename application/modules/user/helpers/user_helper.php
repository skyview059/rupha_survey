<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function userTabs($id, $active_tab)
{
    $html = '<ul class="tabsmenu">';
    $tabs = [
        'profile' => 'Details',
        'password' => 'Password',
        'update' => 'Update',
        'delete' => 'Delete',
    ];

    foreach ($tabs as $link => $tab) {
        $html .= '<li><a href="' . Backend_URL . "user/{$link}/{$id}\"";
        $html .= ($link == $active_tab ) ? ' class="active"' : '';
        $html .= '>' . $tab . '</a></li>';
    }
    $html .= '</ul>';
    return $html;
}

function getRoleName($role_id = 0) {
    $ci =& get_instance();
    $role = $ci->db->get_where('roles', array('id' => $role_id))->row();
    if($role){
        return $role->role_name;
    } else {
        return 'Unknown Role';
    }
}