<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
/* Author: Khairul Azam
 * Date : 10 Jan 2023 @06:40 pm
 */

class Upazila extends Admin_controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Upazila_model');
        $this->load->helper('upazila');
        $this->load->library('form_validation');
    }

    public function index(){
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        
        $config['base_url'] = build_pagination_url( Backend_URL . 'union/upazila/', 'start');
        $config['first_url'] = build_pagination_url( Backend_URL . 'union/upazila/', 'start');
        

        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Upazila_model->total_rows($q);
        $upazilas = $this->Upazila_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'upazilas' => $upazilas,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->viewAdminContent('union/upazila/index', $data);
    }

public function create(){
        $data = array(
            'button' => 'Create',
            'action' => site_url( Backend_URL . 'union/upazila/create_action'),
	    'id' => set_value('id'),
	    'district_id' => set_value('district_id'),
	    'name' => set_value('name'),
	    'bn_name' => set_value('bn_name'),
	);
        $this->viewAdminContent('union/upazila/create', $data);
    }    


    public function create_action(){
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'district_id' => $this->input->post('district_id',TRUE),
		'name' => $this->input->post('name',TRUE),
		'bn_name' => $this->input->post('bn_name',TRUE),
	    );

            $this->Upazila_model->insert($data);
            $this->session->set_flashdata('message', '<p class="ajax_success">Upazila Added Successfully</p>');
            redirect(site_url( Backend_URL. 'union/upazila'));
        }
    }
    
    public function update($id){
        $row = $this->Upazila_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url( Backend_URL . 'union/upazila/update_action'),
		'id' => set_value('id', $row->id),
		'district_id' => set_value('district_id', $row->district_id),
		'name' => set_value('name', $row->name),
		'bn_name' => set_value('bn_name', $row->bn_name),
	    );
            $this->viewAdminContent('union/upazila/update', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Upazila Not Found</p>');
            redirect(site_url( Backend_URL. 'union/upazila'));
        }
    }
    
    public function update_action(){
        $this->_rules();

        $id = $this->input->post('id', TRUE);
        if ($this->form_validation->run() == FALSE) {
            $this->update( $id );
        } else {
            $data = array(
		'district_id' => $this->input->post('district_id',TRUE),
		'name' => $this->input->post('name',TRUE),
		'bn_name' => $this->input->post('bn_name',TRUE),
	    );

            $this->Upazila_model->update($id, $data);
            $this->session->set_flashdata('message', '<p class="ajax_success">Upazila Updated Successlly</p>');
            redirect(site_url( Backend_URL. 'union/upazila/'));
        }
    }public function delete($id){
        $row = $this->Upazila_model->get_by_id($id);

        if ($row) {
            $this->Upazila_model->delete($id);
            $this->session->set_flashdata('message', '<p class="ajax_success">Upazila Deleted Successfully</p>');
            redirect(site_url( Backend_URL. 'union/upazila'));
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Upazila Not Found</p>');
            redirect(site_url( Backend_URL. 'union/upazila'));
        }
    }

    public function _rules(){
	$this->form_validation->set_rules('district_id', 'district id', 'trim|required|is_natural_no_zero');
	$this->form_validation->set_rules('name', 'name', 'trim|required');
	$this->form_validation->set_rules('bn_name', 'bn name', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    


}