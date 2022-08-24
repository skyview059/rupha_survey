<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class User_model extends Fm_model {

    public $table   = 'users';
    public $id      = 'id';
    public $order   = 'ASC';

    function __construct(){
        parent::__construct();
    }
    
    // get total rows
    function total_rows($q = NULL , $status = NULL , $role_id = 0) {
        $this->db->from($this->table);
        $this->_sql($role_id, $status,$q);        
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL , $status = NULL , $role_id = 0) {
        
        $this->db->select('users.*, r.role_name');
        $this->db->select('u.bn_name as union_name, bd_upazilas.bn_name as upazila_name, bd_districts.bn_name as district_name, bd_divisions.bn_name as division_name');
		$this->db->select('u.id as union_id, bd_upazilas.id as upazilla_id, bd_districts.id as district_id, bd_divisions.id as division_id');
        $this->db->from($this->table);
        $this->db->join('roles as r', 'r.id=users.role_id','LEFT');
        $this->db->join('bd_unions as u', 'u.id = users.union_id', 'left');
		$this->db->join('bd_upazilas', 'bd_upazilas.id = u.upazilla_id', 'left');
		$this->db->join('bd_districts', 'bd_districts.id = bd_upazilas.district_id', 'left');
		$this->db->join('bd_divisions', 'bd_divisions.id = bd_districts.division_id', 'left');
        $this->db->order_by('users.id', $this->order);        
        $this->_sql($role_id, $status,$q);        
	    $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }

    function _sql($role_id,$status,$q){
        if($q){ 
            $this->db->group_start();
            $this->db->like('first_name', $q);
            $this->db->or_like('last_name', $q);
            $this->db->or_like('email', $q);
            $this->db->or_like('contact', $q);            
            $this->db->group_end();
        }        
        if($this->role_id != 1){ $this->db->where('role_id >=', 2 ); }
        if($role_id != 0){ $this->db->where('role_id', $role_id ); }        
        if($status){ $this->db->where('status', $status); }        
    }

    function get_by_id($id){
        
		$this->db->select('user.*, role.role_name, u.bn_name as union_name, bd_upazilas.bn_name as upazila_name, bd_districts.bn_name as district_name, bd_divisions.bn_name as division_name');
		$this->db->select('u.id as union_id, bd_upazilas.id as upazilla_id, bd_districts.id as district_id, bd_divisions.id as division_id');
		$this->db->from("{$this->table} as user");
		$this->db->join('bd_unions as u', 'u.id = user.union_id', 'left');
		$this->db->join('bd_upazilas', 'bd_upazilas.id = u.upazilla_id', 'left');
		$this->db->join('bd_districts', 'bd_districts.id = bd_upazilas.district_id', 'left');
		$this->db->join('bd_divisions', 'bd_divisions.id = bd_districts.division_id', 'left');
		$this->db->join('roles as role', 'role.id = user.id', 'left');
        $this->db->where('user.id', $id);
        return $this->db->get()->row();
    }

}