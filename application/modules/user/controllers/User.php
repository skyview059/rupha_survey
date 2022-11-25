<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
/* Author: Khairul Azam
 * Date : 2022-01-14
 */

class User extends Admin_controller{
    function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->load->helper('user');
        $this->load->library('helper');
        $this->load->library('form_validation');
        $this->load->library('user/User_lib');
    }

    public function index(){
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        $config['base_url'] = build_pagination_url( Backend_URL . 'user/', 'start');
        $config['first_url'] = build_pagination_url( Backend_URL . 'user/', 'start');

        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->User_model->total_rows($q);
        $users = $this->User_model->get_limit_data($config['per_page'], $start, $q);

        
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'users' => $users,            
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'role_id' => $this->role_id,
        );
        $this->viewAdminContent('user/user/index', $data);
    }

    public function profile($id){
        $row = $this->User_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'role_id' => $row->role_id,
                'role_name' => getRoleName($row->role_id),
                'union_name' => $row->union_name,
                'upazila_name' => $row->upazila_name,
                'district_name' => $row->district_name,
                'division_name' => $row->division_name,
                'full_name' => $row->full_name,		
                'email' => $row->email,		
                'contact' => $row->contact,
                'created_at' => globalDateFormat($row->created_at),
                'last_access' => $row->last_access,
                'status' => $row->status,
            );
            $this->viewAdminContent('user/user/profile', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">User Not Found</p>');
            redirect(site_url( Backend_URL. 'user'));
        }
    }

    public function create(){
        $data = array(
            'button' => 'Create',
            'action' => site_url( Backend_URL . 'user/create_action'),
            'id' => set_value('id'),
            'role_id' => $this->role_id,
            'full_name' => set_value('full_name'),
            'email' => set_value('email'),	    
            'password' => set_value('password'),	    
            'contact' => set_value('contact'),	    	    
            'status' => set_value('status'),
            'division_id' => set_value('division_id'),
            'district_id' => set_value('district_id'),
            'upazilla_id' => set_value('upazilla_id'),
            'union_id' => set_value('union_id'),
        );
        $this->viewAdminContent('user/user/create', $data);
    }
    
    public function create_action(){
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'role_id' => $this->input->post('role_id',TRUE),
                'full_name' => $this->input->post('full_name',TRUE),
                'email' => $this->input->post('email',TRUE),
                'password' => $this->input->post('password',TRUE),
                'contact' => $this->input->post('contact',TRUE),
                'created_at' => date('Y-m-d H:i:s'),
                'last_access' => '',
                'status' => $this->input->post('status',TRUE),
	        );

            if(in_array($this->input->post('role_id'), [3,4])){
                $data['union_id'] = $this->input->post('union_id',TRUE);
            }

            $this->User_model->insert($data);
            $this->session->set_flashdata('message', '<p class="ajax_success">User Added Successfully</p>');
            redirect(site_url( Backend_URL. 'user'));
        }
    }
    
    public function update($id){
        $row = $this->User_model->get_by_id($id);
        
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url( Backend_URL . 'user/update_action'),
                'id' => set_value('id', $row->id),
                'role_id' => $row->role_id,
                'role_name' => getRoleName($row->role_id),
                'union_name' => $row->union_name,
                'upazila_name' => $row->upazila_name,
                'district_name' => $row->district_name,
                'division_name' => $row->division_name,
                'full_name' => set_value('full_name', $row->full_name),
                'email' => set_value('email', $row->email),		
                'contact' => set_value('contact', $row->contact),				
                'status' => set_value('status', $row->status),
                'division_id' => set_value('division_id', $row->division_id),
                'district_id' => set_value('district_id', $row->district_id),
                'upazilla_id' => set_value('upazilla_id', $row->upazilla_id),
                'union_id' => set_value('union_id', $row->union_id),
            );

            
            $this->viewAdminContent('user/user/update', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">User Not Found</p>');
            redirect(site_url( Backend_URL. 'user'));
        }
    }
    
    public function update_action(){
        $this->_rules();

        $id = $this->input->post('id', TRUE);
        if ($this->form_validation->run() == FALSE) {
            $this->update( $id );
        } else {
            $data = array(
                'role_id' => $this->input->post('role_id',TRUE),
                'full_name' => $this->input->post('full_name',TRUE),		
                'email' => $this->input->post('email',TRUE),		
                'contact' => $this->input->post('contact',TRUE),		
                'status' => $this->input->post('status',TRUE),
                'updated_at' => date('Y-m-d H:i:s'),
            );

            if(in_array($this->input->post('role_id'), [3,4])){
                $data['union_id'] = $this->input->post('union_id',TRUE);
            }

            $this->User_model->update($id, $data);
            $this->session->set_flashdata('message', '<p class="ajax_success">User Updated Successlly</p>');
            redirect(site_url( Backend_URL. 'user/update/'. $id ));
        }
    }

    public function delete($id){
        $row = $this->User_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'role_name' => $row->role_name,
                'role_id' => $row->role_id,
                'union_name' => $row->union_name,
                'upazila_name' => $row->upazila_name,
                'district_name' => $row->district_name,
                'division_name' => $row->division_name,
                'full_name' => $row->full_name,
                'email' => $row->email,
                'password' => $row->password,
                'contact' => $row->contact,
                'created_at' => $row->created_at,
                'last_access' => $row->last_access,
                'status' => $row->status,
            );
            $this->viewAdminContent('user/user/delete', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">User Not Found</p>');
            redirect(site_url( Backend_URL. 'user'));
        }
    }


    public function delete_action($id){
        $row = $this->User_model->get_by_id($id);

        if ($row) {
            $this->User_model->delete($id);
            $this->session->set_flashdata('message', '<p class="ajax_success">User Deleted Successfully</p>');
            redirect(site_url( Backend_URL. 'user'));
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">User Not Found</p>');
            redirect(site_url( Backend_URL. 'user'));
        }
    }
    

    public function _menu(){
        // return add_main_menu('User', 'user', 'user', 'fa-hand-o-right');
        return buildMenuForMoudle([
            'module'    => 'User',
            'icon'      => 'fa-hand-o-right',
            'href'      => 'user',                    
            'children'  => [
                [
                    'title' => 'All User',
                    'icon'  => 'fa fa-bars',
                    'href'  => 'user'
                ],[
                    'title' => ' |_ Add New',
                    'icon'  => 'fa fa-plus',
                    'href'  => 'user/create'
                ],[
                    'title' => 'Manage Role',
                    'icon'  => 'fa fa-plus',
                    'href'  => 'user/role'
                ]
            ]        
        ]);
    }

    public function _rules(){
        $this->form_validation->set_rules('role_id', 'role id', 'trim|required|numeric');
        $this->form_validation->set_rules('full_name', 'first name', 'trim|required');	
        $this->form_validation->set_rules('email', 'email', 'trim|required');	
        $this->form_validation->set_rules('contact', 'contact', 'trim');	
        $this->form_validation->set_rules('status', 'status', 'trim|required');

        if(in_array($this->input->post('role_id'), [3,4])){
            $this->form_validation->set_rules('division_id', 'Division', 'trim|required|greater_than[0]');
            $this->form_validation->set_rules('district_id', 'District', 'trim|required|greater_than[0]');
            $this->form_validation->set_rules('upazilla_id', 'Upazilla', 'trim|required|greater_than[0]');
            $this->form_validation->set_rules('union_id', 'Union', 'trim|required|greater_than[0]');
        }

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
    }
    
    public function password( $id ){  
        
        $row = $this->User_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id'            => $row->id,
                'full_name'     => $row->full_name,                
                'email'         => $row->email,
                'password'      => $row->password,
                'status'        => $row->status
            );
            $this->viewAdminContent('user/user/password', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Record Not Found</p>');
            redirect( site_url( Backend_URL . 'users') );
        }        
    }
    
    public function reset_password(){
        ajaxAuthorized();
        $user_id  = intval( $this->input->post('user_id') );
        $new_pass = $this->input->post('new_pass');
        $con_pass = $this->input->post('con_pass');
                        
        if ($new_pass != $con_pass) {
            echo ajaxRespond('Fail', '<p class="ajax_error">Confirm Password Not Match</p>');                
            exit;
        }
     
        $hass_pass = password_encription( $new_pass ); 
        
        $this->db->set('password', $hass_pass);
        $this->db->where('id', $user_id);
        $this->db->update('users');
        echo ajaxRespond('OK', '<p class="ajax_success">Password Reset Successfully</p>');                  
    }
    

    public function getDivision($division_id)
    {
        $districts = Helper::getDistricts(0, $division_id);
        echo ajaxRespond('OK', $districts);    
    }
    public function getDistrict($district_id)
    {
        $upazilas = Helper::getUpazilas(0, $district_id);
        echo ajaxRespond('OK', $upazilas);    
    }
    public function getUpazilla($upazilla_id)
    {
        $unions = Helper::getUnions(0, $upazilla_id);
        echo ajaxRespond('OK', $unions);    
    }
}