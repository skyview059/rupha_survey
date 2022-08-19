<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function transTabs($active_tab)
{
    $html = '<ul class="tabsmenu">';
    $tabs = [
//        '' => '<i class="fa fa-signal"></i> Incomes',
        '' => '<i class="fa fa-refresh"></i> Member',
        'expense' => ' <i class="fa fa-random"></i> Ledger',
        'bank' => ' <i class="fa fa-exchange"></i> Banking',
    ];

    foreach ($tabs as $link => $tab) {
        $html .= '<li><a href="' . Backend_URL . "trans/{$link}\"";
        $html .= ($link == $active_tab ) ? ' class="active"' : '';
        $html .= '>' . $tab . '</a></li>';
    }
    $html .= '</ul>';
    return $html;
}
