<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* Author: Khairul Azam
 * Date : 8th Oct 2016
 */

class Profile extends Admin_controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Profile_model');
        $this->load->helper('Profile');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->db->where('id', $this->user_id);
        $user = $this->db->get('users')->row();
        $this->viewAdminContent('index', $user);
    }

    public function update() {
        ajaxAuthorized();
        $datas = [
            'full_name'    => $this->input->post('full_name'),            
            'contact'       => $this->input->post('contact')
        ];

        $this->db->where('id',  $this->user_id)->update('users', $datas);
        echo ajaxRespond('OK', '<p class="ajax_success">Profile Updated Successfully<p>');
    }

    public function password() {
        $this->viewAdminContent('password');
    }

    public function update_password() {

        $old_pass = $this->input->post('old_pass');
        $new_pass = $this->input->post('new_pass');
        $con_pass = $this->input->post('con_pass');

        if ($new_pass != $con_pass) {
            echo ajaxRespond('Fail', '<p class="ajax_error">Confirm Password Not Match</p>');
            exit;
        }


        $user_id = getLoginUserData('user_id');
        $user = $this->db->select('password')
                ->get_where('users', ['id' => $user_id])
                ->row();

        $db_pass = $user->password;
        $verify = password_verify($old_pass, $db_pass);

        if ($verify == true) {

            $hass_pass = password_hash($new_pass, PASSWORD_BCRYPT, ["cost" => 12]);
            $this->db->update('users', ['password' => $hass_pass], ['id' => $user_id]);

            echo ajaxRespond('OK', '<p class="ajax_success">Password Reset Successfully</p>');
        } else {
            echo ajaxRespond('Fail', '<p class="ajax_error">Old Password not match, please try again.</p>');
        }
    }
}