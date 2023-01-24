<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* Author: Khairul Azam
 * Date : 2023-01-07
 */

class Benefit extends Admin_controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Benefit_model');
        $this->load->helper('benefit');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        $config['base_url'] = build_pagination_url(Backend_URL . 'benefit/', 'start');
        $config['first_url'] = build_pagination_url(Backend_URL . 'benefit/', 'start');

        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Benefit_model->total_rows($q);
        $benefits = $this->Benefit_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'benefits' => $benefits,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->viewAdminContent('benefit/benefit/index', $data);
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url(Backend_URL . 'benefit/create_action'),
            'id' => set_value('id'),
            'name_ba' => set_value('name_ba'),
            'name_en' => set_value('name_en'),
        );
        $this->viewAdminContent('benefit/benefit/create', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'name_ba' => $this->input->post('name_ba', TRUE),
                'name_en' => $this->input->post('name_en', TRUE),
            );

            $this->Benefit_model->insert($data);
            $this->session->set_flashdata('message', '<p class="ajax_success">Benefit Added Successfully</p>');
            redirect(site_url(Backend_URL . 'benefit'));
        }
    }

    public function update($id)
    {
        $row = $this->Benefit_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url(Backend_URL . 'benefit/update_action'),
                'id' => set_value('id', $row->id),
                'name_ba' => set_value('name_ba', $row->name_ba),
                'name_en' => set_value('name_en', $row->name_en),
            );
            $this->viewAdminContent('benefit/benefit/update', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Benefit Not Found</p>');
            redirect(site_url(Backend_URL . 'benefit'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        $id = $this->input->post('id', TRUE);
        if ($this->form_validation->run() == FALSE) {
            $this->update($id);
        } else {
            $data = array(
                'name_ba' => $this->input->post('name_ba', TRUE),
                'name_en' => $this->input->post('name_en', TRUE),
            );

            $this->Benefit_model->update($id, $data);
            $this->session->set_flashdata('message', '<p class="ajax_success">Benefit Updated Successlly</p>');
            redirect(site_url(Backend_URL . 'benefit/update/' . $id));
        }
    }

    
    public function delete($id)
    {
        $row = $this->Benefit_model->get_by_id($id);

        if ($row) {
            $this->Benefit_model->delete($id);
            $this->session->set_flashdata('message', '<p class="ajax_success">Benefit Deleted Successfully</p>');
            redirect(site_url(Backend_URL . 'benefit'));
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Benefit Not Found</p>');
            redirect(site_url(Backend_URL . 'benefit'));
        }
    }

    public function _menu()
    {
        return add_main_menu('Benefit', 'benefit', 'benefit', 'fa-hand-o-right');
    }

    public function _rules()
    {
        $this->form_validation->set_rules('name_ba', 'name ba', 'trim|required');
        $this->form_validation->set_rules('name_en', 'name en', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}
