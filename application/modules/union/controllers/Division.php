<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
/* Author: Khairul Azam
 * Date : 10 Jan 2023 @06:41 pm
 */

class Division extends Admin_controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Division_model');
        $this->load->helper('division');
        $this->load->library('form_validation');
    }

    public function index(){
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        
        $config['base_url'] = build_pagination_url( Backend_URL . 'union/division/', 'start');
        $config['first_url'] = build_pagination_url( Backend_URL . 'union/division/', 'start');
        

        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Division_model->total_rows($q);
        $divisions = $this->Division_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'divisions' => $divisions,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->viewAdminContent('union/division/index', $data);
    }

public function create(){
        $data = array(
            'button' => 'Create',
            'action' => site_url( Backend_URL . 'union/division/create_action'),
	    'id' => set_value('id'),
	    'name' => set_value('name'),
	    'bn_name' => set_value('bn_name'),
	);
        $this->viewAdminContent('union/division/create', $data);
    }    


    public function create_action(){
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'name' => $this->input->post('name',TRUE),
		'bn_name' => $this->input->post('bn_name',TRUE),
	    );

            $this->Division_model->insert($data);
            $this->session->set_flashdata('message', '<p class="ajax_success">Division Added Successfully</p>');
            redirect(site_url( Backend_URL. 'union/division'));
        }
    }
    
    public function update($id){
        $row = $this->Division_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url( Backend_URL . 'union/division/update_action'),
		'id' => set_value('id', $row->id),
		'name' => set_value('name', $row->name),
		'bn_name' => set_value('bn_name', $row->bn_name),
	    );
            $this->viewAdminContent('union/division/update', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Division Not Found</p>');
            redirect(site_url( Backend_URL. 'union/division'));
        }
    }
    
    public function update_action(){
        $this->_rules();

        $id = $this->input->post('id', TRUE);
        if ($this->form_validation->run() == FALSE) {
            $this->update( $id );
        } else {
            $data = array(
		'name' => $this->input->post('name',TRUE),
		'bn_name' => $this->input->post('bn_name',TRUE),
	    );

            $this->Division_model->update($id, $data);
            $this->session->set_flashdata('message', '<p class="ajax_success">Division Updated Successlly</p>');
            redirect(site_url( Backend_URL. 'union/division/'));
        }
    }public function delete($id){
        $row = $this->Division_model->get_by_id($id);

        if ($row) {
            $this->Division_model->delete($id);
            $this->session->set_flashdata('message', '<p class="ajax_success">Division Deleted Successfully</p>');
            redirect(site_url( Backend_URL. 'union/division'));
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Division Not Found</p>');
            redirect(site_url( Backend_URL. 'union/division'));
        }
    }

    public function _rules(){
	$this->form_validation->set_rules('name', 'name', 'trim|required');
	$this->form_validation->set_rules('bn_name', 'bn name', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    


}