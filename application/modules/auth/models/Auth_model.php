<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends Fm_model{

    public $table   = 'users';
    
    function __construct(){
        parent::__construct();
    }

    /**
     * @param $username string    
     * @return array
     */
    function validateUser($username){
        return $this->db
                ->select('id,role_id,full_name,email,password,status')
                ->get_where($this->table, ['email' => $username] )
                ->row();
    }
    
    
            
    function sign_up($data){                
        $this->db->insert($this->table, $data);
    }
                     
}