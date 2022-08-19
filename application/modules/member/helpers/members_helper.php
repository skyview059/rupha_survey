<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function memberTabs($id, $active_tab) {
    $html = '<ul class="tabsmenu">';
    $tabs = [
        'stmt'      => '<i class="fa fa-bars"></i> Statement',
        'profile'   => '<i class="fa fa-user"></i> Profile',
        'update'    => '<i class="fa fa-edit"></i> Update',
        'delete'    => '<i class="fa fa-times"></i> Delete',
    ];

    foreach ($tabs as $link => $tab) {
        $html .= '<li> <a href="' . Backend_URL . 'member/' . $link . '/' . $id . '"';
        $html .= ($link === $active_tab ) ? ' class="active"' : '';
        $html .= '> ' . $tab . '</a></li>';
    }
    $html .= '</ul>';
    return $html;
}

function paidDate($datetime = '0000-00-00') {

    if ($datetime == '0000-00-00') {
        return '-------';
    }
    return date('d-M-y', strtotime($datetime));
}