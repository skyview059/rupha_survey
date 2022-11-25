<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends Fm_model{

    public $table   = 'users';
    
    function __construct(){
        parent::__construct();
    }

    function validateUser($username){
        return $this->db
                ->select('id,role_id,union_id,full_name,email,password,status')
                ->get_where($this->table, ['email' => $username] )
                ->row();
    }
    
    function setLastAccess($username){
        $this->db->set('last_access', date('Y-m-d H:i:s'));
        $this->db->where('email', $username );
        $this->db->update($this->table);
    }
            
    function sign_up($data){                
        $this->db->insert($this->table, $data);
    }
                     
}