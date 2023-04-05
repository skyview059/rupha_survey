<?php

/** @author Kanny */
class Helper {    
    
    public static function getUserName($user_id = 0) {
        $ci =& get_instance();        
        $ci->db->select('full_name');
        $ci->db->where('id', $user_id);
        $user = $ci->db->get('users')->row();
        return ($user) ? $user->full_name : "-xx-{$user_id}";
    }
    
    public static function memberName($id = 0) {
        return self::getSingleColumnName('members', 'name', $id);
    }
         
    public static function getMemberDropDown( $area_id = 0, $label = '--Select--' ) {
                
        $ci = & get_instance();
        $ci->db->select('id,name,contact');
        if($area_id){ $ci->db->where('area_id', $area_id) ; }
        $members = $ci->db->get('members')->result();  
        $row = '<option value="0">' . $label . '</option>';
        $sl = 0;
        foreach ($members as $subs) {
            $sl++;
            $row .= "<option value=\"{$subs->id}\">";
            $row .= $sl .'. ';            
            $row .= $subs->name . ', '. $subs->contact;
            $row .= '</option>';
        }
        return $row;
        
    }    
    
    public static function getUserDropDown($id = 0, $label = '--Select--') {
        $ci = & get_instance();
        $ci->db->select('id,full_name');
        $role_id = getLoginUserData('role_id');
        if($role_id != 1){ $ci->db->where('role_id !=', 1); }
        $users = $ci->db->get('users')->result();            
        $row = '<option value="0">' . $label . '</option>';
        foreach ($users as $user) {
            $row .= '<option value="' . $user->id . '"';
            $row .= ($id == $user->id ) ? ' selected' : '';
            $row .= '>'. $user->full_name .'</option>';
        }
        return $row;
    }
    
                    
    public static function getTableToSelector($table, $column, $label, $selected = 0, $get_where_col = false, $get_where_val = 0) {
        $ci = & get_instance();
        $exists = $ci->db->table_exists($table);

        
        if (!$exists) {
            return '<option>-: Tbl ' . $table . ' Not Exists :-</option>';
        }
        
        
        if ($get_where_col) {
            $ci->db->where($get_where_col, $get_where_val);
        } 
        $results = $ci->db->get($table)->result();
        
        if (!$results) {
            return '<option ="0">No Item Found</p>';
        }

        $opt = '<option value="0">' . $label . '</option>';
        foreach ($results as $row) {
            $opt .= '<option value="' . $row->id . '"';
            $opt .= ($selected == $row->id ) ? ' selected' : '';
            $opt .= '>';
            $opt .= ($row->$column) ? $row->$column : '-- ID#' . $row->id;
            $opt .= '</option>';
        }
        return $opt;
    }

    private static function getSingleColumnName($table, $column, $id = 0) {
        $ci = & get_instance();
        $exists = $ci->db->table_exists($table);

        if ($exists) {
            $result = $ci->db->get_where($table, ['id' => $id])->row();
            if ($result) {
                return $result->$column;
            }
        } else {
            return '-: Tbl ' . $table . ' Not Exists :-';
        }
    }    
    
    public static function getDropDownHead($category,$type, $select = 0, $label = '--Select--' ) {
                
        $ci = & get_instance();
        $ci->db->select('id,name');
        $ci->db->where('category', $category );
        $ci->db->where('type', $type );
        $heads = $ci->db->get('ledger_heads')->result();  
        $row = '<option value="0">' . $label . '</option>';
        $sl = 0;
        foreach ($heads as $head) {
            $sl++;
            $row .= "<option value=\"{$head->id}\"";
            $row .= ($select == $head->id ) ? ' selected' : '';            
            $row .= ">{$head->name}</option>";
        }
        return $row;
        
    }
    

    public static function getDivisions($selected_id = 0) {
        return self::getTableToSelector('bd_divisions', 'bn_name', '-- Select Division --', $selected_id);
    }
    
    public static function getDistricts($selected_id = 0, $division_id = 0, $label = '-- Select District --') {
        $ci = &get_instance();
        $ci->db->select('id,bn_name,name');
        $results = $ci->db->order_by('id', 'ASC')
            ->where('division_id', $division_id)
            ->get('bd_districts')
            ->result();
    
        $row = '<option value="0">' . $label . '</option>';
        foreach ($results as $result) {
            $row .= '<option value="' . $result->id . '"';
            $row .= ($selected_id == $result->id) ? ' selected' : '';
            $row .= '>';
            $row .= $result->bn_name;
            $row .= '</option>' . "\r\n";
        }
        return $row;
    }
    
    public static function getUpazilas($selected_id = 0, $district_id = 0, $label = '-- Select Upazila --') {
        $ci = &get_instance();
        $ci->db->select('id,bn_name,name');
        $results = $ci->db->order_by('id', 'ASC')
            ->where('district_id', $district_id)
            ->get('bd_upazilas')
            ->result();
    
        $row = '<option value="0">' . $label . '</option>';
        foreach ($results as $result) {
            $row .= '<option value="' . $result->id . '"';
            $row .= ($selected_id == $result->id) ? ' selected' : '';
            $row .= '>';
            $row .= $result->bn_name;
            $row .= '</option>' . "\r\n";
        }
        return $row;
    }
    
    public static function getUnions($selected_id = 0, $upazilla_id = 0, $label = '-- Select Union --') {
        $ci = &get_instance();
        $ci->db->select('id,bn_name,name');
        $results = $ci->db->order_by('id', 'ASC')
            ->where('upazilla_id', $upazilla_id)
            ->get('bd_unions')
            ->result();
    
        $row = '<option value="0">' . $label . '</option>';
        foreach ($results as $result) {
            $row .= '<option value="' . $result->id . '"';
            $row .= ($selected_id == $result->id) ? ' selected' : '';
            $row .= '>';
            $row .= $result->bn_name;
            $row .= '</option>' . "\r\n";
        }
        return $row;
    }

    public static function getSecretaryDropDown($id = 0, $label = '--Select Secretary--') {
        $ci = & get_instance();
        $ci->db->select('id,full_name');
        $ci->db->where('role_id', 3);
        $users = $ci->db->get('users')->result();   
        
        $opt = '<option value="0">' . $label . '</option>';
        foreach ($users as $user) {
            $opt .= '<option value="' . $user->id . '"';
            $opt .= ($id == $user->id ) ? ' selected' : '';
            $opt .= '>'. $user->full_name .'</option>';
        }
        return $opt;
    }
}
