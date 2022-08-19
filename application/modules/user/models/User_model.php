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
        $this->db->from($this->table);
        $this->db->join('roles as r', 'r.id=users.role_id','LEFT');
        
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
}