<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* Author: Khairul Azam
 * Date : 2022-08-21
 */

class Summary extends Admin_controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Member_model');
    }

    public function index()
    {

        $data = [];
        $this->viewAdminContent('member/member/summary', $data);
    }
    
}
