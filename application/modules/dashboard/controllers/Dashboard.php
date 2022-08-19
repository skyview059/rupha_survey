<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_controller {    
    
    function __construct() {
        parent::__construct();
        $this->load->helper('dashboard');                
    }
    
    public function index(){        
        $setDate = date('Y-m-d');
        $data['date'] = $setDate;
        $this->viewAdminContent('dashboard', $data);
    }
}