<?php

/** @author Kanny */
class Helper {    
    
    public static function getUserName($user_id = 0) {
        $ci = & get_instance();
        
        $ci->db->select('full_name');
        $ci->db->where('id', $user_id);
        $user = $ci->db->get('users')->row();
        
        if($user){
            return $user->full_name;
        } else {
            return 'Unknown #ID-' . $user_id;
        }
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

        $row = '<option value="0">' . $label . '</option>';
        if ($exists) {
            if ($get_where_col) {
                $results = $ci->db->get_where($table, [$get_where_col => $get_where_val])->result();
            } else {
                $results = $ci->db->get($table)->result();
            }

            foreach ($results as $result) {
                $row .= '<option value="' . $result->id . '"';
                $row .= ($selected == $result->id ) ? ' selected' : '';
                $row .= '>';
                $row .= ($result->$column) ? $result->$column : '-- ID#' . $result->id;
                $row .= '</option>';
            }

            if (count($results) == 0) {
                $row .= '<option ="0">No Item Found</p>';
            }
        } else {
            $row .= '<option>-: Tbl ' . $table . ' Not Exists :-</option>';
        }
        return $row;
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

    private static function getIncomeSource($selected_id = 0, $label = '-- নির্বাচন করুন --') {
        $ci = &get_instance();
        $ci->db->select('id,name_ba');
        $results = $ci->db->order_by('id', 'ASC')
            ->get('income_sources')
            ->result();
    
        $row = '<option value="0">' . $label . '</option>';
        foreach ($results as $result) {
            $row .= '<option value="' . $result->id . '"';
            $row .= ($selected_id == $result->id) ? ' selected' : '';
            $row .= '>';
            $row .= $result->name_ba;
            $row .= '</option>' . "\r\n";
        }
        return $row;
    }
    

    public static function getDivisions($selected_id = 0, $label = '-- Select Division --') {
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
            $row .= $result->name;
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
            $row .= $result->name;
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
            $row .= $result->name;
            $row .= '</option>' . "\r\n";
        }
        return $row;
    }
    
    

}
