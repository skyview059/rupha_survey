<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_lib {

    public static function Delete($id = 1, $status = 'Unlocked') {

        if ($status == 'Unlocked') {
            return '<span onClick="delete_role(' . $id . ')" class="btn btn-danger btn-xs"> <i class="fa fa-trash-o"></i> Delete</span>';
        } else {
            return '<span class="btn btn-default btn-xs disabled"> <i class="fa fa-lock"></i> Locked</span>';
        }
    }

    public static function getModules($array = [], $role_id=0) {
        $html = '';
        if (empty($array)) {
            return $html;
        }
        
        foreach ($array as $key => $row) {
            $set  = 'module_' .$key;
            $html .= '<div class="col-md-12 form-group" id="'. $set .'">';
            $html .= '<input type="hidden" name="role_id" value="' . $role_id . '">';                
            $html .= "<div class=\"acl_module_name\" onclick=\"checkUncheck('". $set ."');\">";
            $html .= $row['module_name'];
            $html .= '&nbsp;&nbsp;<small class="text-red"> <i class="fa fa-check-square-o"></i>   Mark/Un-Mark All</small>';
            $html .= '</div>';
            $html .= self::getAcls($row['moulde_acls'], $role_id, $set);
            $html .= '</div>';
        }
        return $html;
    }

    public static function getAcls($array = [], $role_id = 0, $class = 'class') {
        $html = '<ul>';
        foreach ($array as $row) {
            $html .= '<li><label><input type="checkbox" class="'.$class.'" name="acl_id[]"';
            $html .= (self::isCheck($role_id, $row->id)) ? ' checked ' : '';
            $html .= 'value="' . $row->id . '"';
            $html .= '/>&nbsp;' . $row->permission_name . '</lable></li>';
        }
        $html .= '</ul>';
        return $html;
    }

    public static function isCheck($role_id = 0, $acl_id = 0) {
        $ci = & get_instance();
        return $ci->db->where('role_id', $role_id)
                ->where('acl_id', $acl_id)
                ->count_all_results('role_permissions');      
    }

    public static function makeTab($id, $active_tab) {
        $html = '<ul class="tabsmenu">';
        $tabs = [
            'profile' => 'View Profile',            
            'update' => 'Update',
            'password' => 'Change Password',
            'delete' => 'Freeze/Unfreeze',
        ];
        foreach ($tabs as $link => $tab) {
            $html .= '<li><a href="' . Backend_URL . 'users/' . $link . '/' . $id . '"';
            $html .= ($link == $active_tab ) ? ' class="active"' : '';
            $html .= ">{$tab}</a></li>";
        }
        $html .= '</ul>';
        return $html;
    }

    public static function getDropDownRoleName($role_id = 0) {
        $ci = & get_instance();
        $current_user_role_id = getLoginUserData('role_id');

        if($current_user_role_id != 1 ){
            $ci->db->where('id !=', 1 );
        }
        $roles = $ci->db->get('roles')->result();
        
        $options = '';
        foreach ($roles as $role) {
            $options .= '<option value="' . $role->id . '" ';
            $options .= ($role->id == $role_id ) ? 'selected="selected"' : '';
            $options .= '>' . $role->role_name . '</option>';
        }
        return $options;
    }   
    public static function getSecretaryAccounts($limit = 25 ) {
        $ci = & get_instance();        
        $ci->db->where('role_id', 1 );
        $data['users'] = $ci->db->get('users')->result();
        $ci->load->view('dashboard/secterary', $data);
    }    
}