<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_controller {    
    
    function __construct() {
        parent::__construct();
        $this->load->model('member/Member_model');
        $this->load->helper('dashboard');                
    }
    
    public function index(){
        $members = $this->Member_model->get_latest_members(50);
       
        $data['start'] = 0;
        $data['members'] = $members;
        if(in_array($this->role_id, [3,4])){
            $union_id = getLoginUserData('union_id');
		    $union_info = $this->Member_model->getUnionInfoById($union_id);
            $data['union_info'] = $union_info;
            $this->viewAdminContent('secretary', $data);
        }else{
            $this->viewAdminContent('dashboard', $data);
        }
        
    }
}