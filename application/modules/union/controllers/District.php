<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
/* Author: Khairul Azam
 * Date : 10 Jan 2023 @06:42 pm
 */

class District extends Admin_controller{
    function __construct(){
        parent::__construct();
        $this->load->model('District_model');
        $this->load->helper('district');
        $this->load->library('form_validation');
    }

    public function index(){
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        
        $config['base_url'] = build_pagination_url( Backend_URL . 'union/district/', 'start');
        $config['first_url'] = build_pagination_url( Backend_URL . 'union/district/', 'start');
        

        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->District_model->total_rows($q);
        $districts = $this->District_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'districts' => $districts,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->viewAdminContent('union/district/index', $data);
    }

public function create(){
        $data = array(
            'button' => 'Create',
            'action' => site_url( Backend_URL . 'union/district/create_action'),
	    'id' => set_value('id'),
	    'division_id' => set_value('division_id'),
	    'name' => set_value('name'),
	    'bn_name' => set_value('bn_name'),
	);
        $this->viewAdminContent('union/district/create', $data);
    }    


    public function create_action(){
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'division_id' => $this->input->post('division_id',TRUE),
		'name' => $this->input->post('name',TRUE),
		'bn_name' => $this->input->post('bn_name',TRUE),
	    );

            $this->District_model->insert($data);
            $this->session->set_flashdata('message', '<p class="ajax_success">District Added Successfully</p>');
            redirect(site_url( Backend_URL. 'union/district'));
        }
    }
    
    public function update($id){
        $row = $this->District_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url( Backend_URL . 'union/district/update_action'),
		'id' => set_value('id', $row->id),
		'division_id' => set_value('division_id', $row->division_id),
		'name' => set_value('name', $row->name),
		'bn_name' => set_value('bn_name', $row->bn_name),
	    );
            $this->viewAdminContent('union/district/update', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">District Not Found</p>');
            redirect(site_url( Backend_URL. 'union/district'));
        }
    }
    
    public function update_action(){
        $this->_rules();

        $id = $this->input->post('id', TRUE);
        if ($this->form_validation->run() == FALSE) {
            $this->update( $id );
        } else {
            $data = array(
		'division_id' => $this->input->post('division_id',TRUE),
		'name' => $this->input->post('name',TRUE),
		'bn_name' => $this->input->post('bn_name',TRUE),
	    );

            $this->District_model->update($id, $data);
            $this->session->set_flashdata('message', '<p class="ajax_success">District Updated Successlly</p>');
            redirect(site_url( Backend_URL. 'union/district/'));
        }
    }public function delete($id){
        $row = $this->District_model->get_by_id($id);

        if ($row) {
            $this->District_model->delete($id);
            $this->session->set_flashdata('message', '<p class="ajax_success">District Deleted Successfully</p>');
            redirect(site_url( Backend_URL. 'union/district'));
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">District Not Found</p>');
            redirect(site_url( Backend_URL. 'union/district'));
        }
    }

    public function _rules(){
	$this->form_validation->set_rules('division_id', 'division id', 'trim|required|is_natural_no_zero');
	$this->form_validation->set_rules('name', 'name', 'trim|required');
	$this->form_validation->set_rules('bn_name', 'bn name', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    


}