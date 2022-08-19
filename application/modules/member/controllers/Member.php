<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
/* Author: Khairul Azam
 * Date : 12th Jan, 2022
 */

class Member extends Admin_controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Member_model');
        
        $this->load->helper('members');
        $this->load->library('form_validation');
    }

    public function index(){
        $q = urldecode($this->input->get('q', TRUE));        
        $balance = ($this->input->get('balance')) ?  $this->input->get('balance') : 'Any';
        
        
        $limit = ($this->input->get('limit')) ? (int)$this->input->get('limit') : 200;
        $start = intval($this->input->get('start'));
                         
        $config['base_url'] = build_pagination_url( Backend_URL . 'member', 'start' );;
        $config['first_url'] = build_pagination_url( Backend_URL . 'member', 'start' );
         
        $config['per_page'] = $limit;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Member_model->total_rows($q,$balance);
                
        $members = $this->Member_model->get_limit_data($config['per_page'], $start, $q,$balance);
        
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'members' => $members,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,            
            'limit' => $limit,
            'balance' => $balance            
        );
        $this->viewAdminContent('member/member/index', $data);
    }
    
    public function stmt( $id = 0){  
        
        $this->db->where('member_id', $id);
        $stmts = $this->db->get('member_stmt')->result();
        
        $member = $row = $this->Member_model->get_by_id($id);
        
        $data['name']    = $member->name;                
        $data['address'] = $member->address;                
        $data['contact'] = $member->contact;
        
        $data['stmts'] = $stmts;                
        $data['start'] = 0;                
        $data['id'] = $id;
                    
        $this->viewAdminContent('member/member/stmt', $data);
    }
               
    public function profile($id){
        $row = $this->Member_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id'        => $row->id,		
		'ref_id'    => $row->ref_id,		
		'name'      => $row->name,		
                'photo'     => $row->photo,
		'contact'   => $row->contact,
		'address'   => nl2br($row->address),
		'join_date' => globalDateFormat($row->join_date),		
		'remark'    => nl2br($row->remark),		
		'status'    => $row->status,
	    );
            $this->viewAdminContent('member/member/profile', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Member Not Found</p>');
            redirect(site_url( Backend_URL. 'member'));
        }
    }

    public function create(){
        $data = array(
            'button' => 'Registration',
            'action' => site_url( Backend_URL . 'member/create_action'),
	    'id' => set_value('id'),	    	    
	    'ref_id' => set_value('ref_id'),
	    'name' => set_value('name'),	    
	    'contact' => set_value('contact'),
	    'address' => set_value('address'),
	    'join_date' => set_value('join_date', date('Y-m-d')),
	    'remark' => set_value('remark'),	    
	    'status' => set_value('status', 'Active'),
	);
        $this->viewAdminContent('member/member/create', $data);
    }
    
    public function create_action(){
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'ref_id' => $this->input->post('ref_id',TRUE),		
		'name' => $this->input->post('name',TRUE),		
		'contact' => $this->input->post('contact',TRUE),
		'address' => $this->input->post('address',TRUE),
		'join_date' => $this->input->post('join_date',TRUE),                
		'total_dr' => 0,
		'total_cr' => 0,
		'balance' => 0,
		'remark' => $this->input->post('remark',TRUE),	
		'status' => $this->input->post('status',TRUE),
	    );

            $member_id = $this->Member_model->insert($data);
            $this->session->set_flashdata('message', '<p class="ajax_success">Member Registration Successfully</p>');
//            redirect(site_url( Backend_URL. 'member'));
            redirect(site_url( Backend_URL. 'member/update/'. $member_id ));
        }
    }
    
    public function update($id){
        $row = $this->Member_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url( Backend_URL . 'member/update_action'),
		'id' => set_value('id', $row->id),
		'ref_id' => set_value('ref_id', $row->ref_id),		
		'name' => set_value('name', $row->name),
		'photo' => set_value('photo', $row->photo ),
		'contact' => set_value('contact', $row->contact),
		'address' => set_value('address', $row->address),
		'join_date' => set_value('join_date', $row->join_date),
		'remark' => set_value('remark', $row->remark),		
		'status' => set_value('status', $row->status),
	    );
            $this->viewAdminContent('member/member/update', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Member Not Found</p>');
            redirect(site_url( Backend_URL. 'member'));
        }
    }
    
    public function update_action(){
        $this->_rules();

        $id = $this->input->post('id', TRUE);
        if ($this->form_validation->run() == FALSE) {
            $this->update( $id );
        } else {
            $path  = 'uploads/members/' . date('Y/m/');
            $name  = uniqid();
            $photo = uploadPhoto($_FILES['photo'], $path, $name);
            if(empty($photo)){
                $photo = $this->input->post('old_photo',TRUE);
            }
            
            $data = array(
		'ref_id' => $this->input->post('ref_id',TRUE),		
		'name' => $this->input->post('name',TRUE),                
                'photo'   => $photo,		
		'contact' => $this->input->post('contact',TRUE),
		'address' => $this->input->post('address',TRUE),
		'join_date' => $this->input->post('join_date',TRUE),
		'remark' => $this->input->post('remark',TRUE),	
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Member_model->update($id, $data);
            $this->session->set_flashdata('message', '<p class="ajax_success">Member Updated Successlly</p>');
            redirect(site_url( Backend_URL. 'member/update/'. $id ));
        }
    }

    public function delete($id){
        $row = $this->Member_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'ref_id' => $row->ref_id,
		'name' => $row->name,		
		'contact' => $row->contact,
		'address' => $row->address,
		'join_date' => globalDateFormat($row->join_date),
		'remark' => nl2br($row->remark),	
		'status' => $row->status,
		'bill_record' => $this->check_before_delete( $id ),		
		'force' => ($this->role_id == 1) ? true : false,
	    );
            $this->viewAdminContent('member/member/delete', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Member Not Found</p>');
            redirect(site_url( Backend_URL. 'member'));
        }
    }

    private function check_before_delete( $id = 0 ){
        $this->db->where('member_id', $id );
        return $this->db->count_all_results('member_stmt');
    }

    public function delete_action($id){
        $row = $this->Member_model->get_by_id($id);

        $bill_count = $this->check_before_delete( $id );
        if($bill_count){
            $this->session->set_flashdata('message', '<p class="ajax_error">This member has '.$bill_count.' bill record(s). So \'Delete\' is not accept</p>');
            redirect(site_url( Backend_URL. 'member'));
        }
        
        
        if ($row) {
            $this->Member_model->delete($id);
            $this->session->set_flashdata('message', '<p class="ajax_success">Member Deleted Successfully</p>');
            redirect(site_url( Backend_URL. 'member'));
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Member Not Found</p>');
            redirect(site_url( Backend_URL. 'member'));
        }
    }
    
    public function force_delete($id){
        
        $row = $this->Member_model->get_by_id($id);
        if($row){
            $this->db->where('member_id', $id);
            $this->db->delete('member_stmt');

            $this->Member_model->delete($id);
            $this->session->set_flashdata('message', '<p class="ajax_success">Member Forced Deleted Successfully Will Bills</p>');
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_success">Member not found to delete</p>');
        }
        redirect(site_url( Backend_URL. 'member'));
    }
    

    public function _menu(){
        return add_main_menu('Member', 'member', 'member', 'fa-gear');
        /*
        return buildMenuForMoudle([
            'module'    => 'Member',
            'icon'      => 'fa-hand-o-right',
            'href'      => 'member',                    
            'children'  => [
                [
                    'title' => 'All Member',
                    'icon'  => 'fa fa-bars',
                    'href'  => 'member'
                ],[
                    'title' => 'Member Group',
                    'icon'  => 'fa fa-plus',
                    'href'  => 'member/group'
                ]
            ]        
        ]);
         * 
         */
    }

    public function _rules(){	
	$this->form_validation->set_rules('ref_id', ' ref id', 'trim|required');	
	$this->form_validation->set_rules('name', ' name', 'trim|required');		
	$this->form_validation->set_rules('contact', 'contact', 'trim|min_length[11]|max_length[11]');
		
	$this->form_validation->set_rules('join_date', 'join date', 'trim|required');	
	
	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}