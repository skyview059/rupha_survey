<?php

/**
 * Description of Area_lib
 *
 * @author LENOVO
 */
class Area_lib extends CI_Controller {
    
    static function getDDDivision($selected=0,$label='Select Division'){
        Helper::getTableToSelector('bd_divisions', 'name', $label, $selected, $get_where_col, $get_where_val);
    }
}
