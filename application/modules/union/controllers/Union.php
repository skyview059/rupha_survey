<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
/* Author: Khairul Azam
 * Date : 2023-01-10
 */

class Union extends Admin_controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Union_model');
        $this->load->helper('union');
        $this->load->library('form_validation');
    }

    public function index(){
                
        $q = urldecode($this->input->get('q', TRUE));
        $division_id = (int) $this->input->get('division_id');
        $district_id = (int) $this->input->get('district_id');
        $upazilla_id = (int) $this->input->get('upazilla_id');                
        $start = (int) $this->input->get('start');
        
        $config['base_url'] = build_pagination_url( Backend_URL . 'union/', 'start');
        $config['first_url'] = build_pagination_url( Backend_URL . 'union/', 'start');

        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Union_model->total_rows($upazilla_id,$q);
        $unions = $this->Union_model->get_limit_data($config['per_page'], $start,$upazilla_id, $q);               

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'unions' => $unions,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'division_id' => $division_id,
            'district_id' => $district_id,
            'upazilla_id' => $upazilla_id,
        );
        $this->viewAdminContent('union/union/index', $data);
    }

    
    public function create(){
        $data = array(
            'button' => 'Create',
            'action' => site_url( Backend_URL . 'union/create_action'),
	    'id' => set_value('id'),
	    'division_id' => set_value('division_id'),
	    'district_id' => set_value('district_id'),
	    'upazilla_id' => set_value('upazilla_id'),	    
	    'name' => set_value('name'),
	    'bn_name' => set_value('bn_name'),
	);
        $this->viewAdminContent('union/union/create', $data);
    }
    
    public function create_action(){
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'upazilla_id' => $this->input->post('upazilla_id',TRUE),
		'name' => $this->input->post('name',TRUE),
		'bn_name' => $this->input->post('bn_name',TRUE),
	    );

            $this->Union_model->insert($data);
            $this->session->set_flashdata('message', '<p class="ajax_success">Union Added Successfully</p>');
            redirect(site_url( Backend_URL. 'union'));
        }
    }
    
    public function update($id){
        $row = $this->Union_model->get_by_id($id);                

        if ($row) {
            $data = array(
                'button' => 'Update',
                'msg' => $this->input->get('msg'),
                'action' => site_url( Backend_URL . 'union/update_action'),
		'id' => set_value('id', $row->id),
		'division_id' => set_value('division_id', $row->division_id),
		'district_id' => set_value('district_id', $row->district_id),
		'upazilla_id' => set_value('upazilla_id', $row->upazilla_id),		
		'name' => set_value('name', $row->name),
		'bn_name' => set_value('bn_name', $row->bn_name),
	    );
            $this->viewAdminContent('union/union/update', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Union Not Found</p>');
            redirect(site_url( Backend_URL. 'union'));
        }
    }
    
    public function update_action(){
        $this->_rules();

        $id = $this->input->post('id', TRUE);
        if ($this->form_validation->run() == FALSE) {
            $this->update( $id );
        } else {
            $data = array(
		'upazilla_id' => $this->input->post('upazilla_id',TRUE),
		'name' => $this->input->post('name',TRUE),
		'bn_name' => $this->input->post('bn_name',TRUE),
	    );

            $this->Union_model->update($id, $data);            
            redirect(site_url( Backend_URL. 'union/update/'. $id . '?msg=success' ));
        }
    }

    public function delete($id){
        $row = $this->Union_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'upazilla_id' => $row->upazilla_id,
		'name' => $row->name,
		'bn_name' => $row->bn_name,
	    );
            $this->viewAdminContent('union/union/delete', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Union Not Found</p>');
            redirect(site_url( Backend_URL. 'union'));
        }
    }


    public function delete_action($id){
        $row = $this->Union_model->get_by_id($id);

        if ($row) {
            $this->Union_model->delete($id);
            $this->session->set_flashdata('message', '<p class="ajax_success">Union Deleted Successfully</p>');
            redirect(site_url( Backend_URL. 'union'));
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Union Not Found</p>');
            redirect(site_url( Backend_URL. 'union'));
        }
    }
    

    public function _menu(){        
        return buildMenuForMoudle([
            'module'    => 'BD Unions',
            'icon'      => 'fa-hand-o-right',
            'href'      => 'union',                    
            'children'  => [
                [
                    'title' => 'All Union',
                    'icon'  => 'fa fa-bars',
                    'href'  => 'union'
                ],[
                    'title' => ' |_ Add New',
                    'icon'  => 'fa fa-plus',
                    'href'  => 'union/create'
                ]
            ]        
        ]);
    }

    public function _rules(){
	$this->form_validation->set_rules('upazilla_id', 'upazilla id', 'trim|required|numeric');
	$this->form_validation->set_rules('name', 'name', 'trim');
	$this->form_validation->set_rules('bn_name', 'bn name', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    


}