<?php

defined('BASEPATH') or exit('No direct script access allowed');

/* Author: Khairul Azam
 * Date : 2022-08-21
 */

class Member extends Admin_controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Member_model');
        $this->load->helper('member');
        $this->load->library('form_validation');
    }

    public function index()
    {

        $union_id = (int) getLoginUserData('union_id');
        $union_info = $this->Member_model->getUnionInfoById( $union_id );

        $q = urldecode($this->input->get('q', TRUE));
        $division_id = $this->input->get('division_id', TRUE);
        $district_id = $this->input->get('district_id', TRUE);
        $upazilla_id = $this->input->get('upazilla_id', TRUE);
        $union_id = $this->input->get('union_id', TRUE);
        $user_id = $this->input->get('user_id', TRUE);
        $start = intval($this->input->get('start'));

        $config['base_url'] = build_pagination_url(Backend_URL . 'member', 'start');
        $config['first_url'] = build_pagination_url(Backend_URL . 'member', 'start');

        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Member_model->total_rows($q, $division_id, $district_id, $upazilla_id, $union_id, $user_id);
        $members = $this->Member_model->get_limit_data($config['per_page'], $start, $q, $division_id, $district_id, $upazilla_id, $union_id, $user_id);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'members' => $members,
            'role_id' => $this->role_id,
            'division_id' => $division_id,
            'district_id' => $district_id,
            'upazilla_id' => $upazilla_id,
            'union_id' => $union_id,
            'user_id' => $user_id,
            'union_info' => $union_info,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->viewAdminContent('member/member/index', $data);
    }

    public function read($id)
    {

        $row = $this->Member_model->get_by_id($id);
        $taxAssessments = $this->Member_model->get_member_annual_tax($id);

        if ($row) {
            $data = array(
                'id' => $row->id,
                'division_name' => $row->division_name,
                'district_name' => $row->district_name,
                'upazila_name' => $row->upazila_name,
                'union_name' => $row->union_name,
                'present_holding_no' => $row->present_holding_no,
                'word_no' => $row->word_no,
                'village' => $row->village,
                'khana_chief_name_ba' => $row->khana_chief_name_ba,
                'khana_chief_name_en' => $row->khana_chief_name_en,
                'mobile_no' => $row->mobile_no,
                'father_name' => $row->father_name,
                'mother_name' => $row->mother_name,
                'date_of_birth' => $row->date_of_birth,
                'nid' => $row->nid,
                'social_security_benefit_name' => $row->ssb_name,
                'house_members' => $row->house_members,
                'raw_house' => $row->raw_house,
                'half_baked_house' => $row->half_baked_house,
                'paved_house' => $row->paved_house,
                'type_of_infrastructure' => $row->type_of_infrastructure,
                'annual_tax_assessments' => $taxAssessments,
                'created_by' => $row->created_by,
                'updated_by' => $row->updated_by,
                'created_at' => $row->created_at,
                'updated_at' => $row->updated_at,
            );
            $this->viewAdminContent('member/member/read', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Member Not Found</p>');
            redirect(site_url(Backend_URL . 'member'));
        }
    }

    public function create()
    {
        $union_id = (int) getLoginUserData('union_id');
        $union_info = $this->Member_model->getUnionInfoById($union_id);

        $data = array(
            'button' => 'Register',
            'action' => site_url(Backend_URL . 'member/create_action'),
            'role_id' => $this->role_id,
            'id' => set_value('id'),
            'union_id' => set_value('union_id', $union_info->id ?? ''),
            'union_name' => $union_info->union_name ?? '',
            'union_bn_name' => $union_info->union_bn_name ?? '',
            'upazilla_id' => $union_info->upazilla_id ?? 0,
            'present_holding_no' => set_value('present_holding_no'),
            'word_no' => set_value('word_no'),
            'village' => set_value('village'),
            'khana_chief_name_ba' => set_value('khana_chief_name_ba'),
            'khana_chief_name_en' => set_value('khana_chief_name_en'),
            'mobile_no' => set_value('mobile_no'),
            'father_name' => set_value('father_name'),
            'mother_name' => set_value('mother_name'),
            'date_of_birth' => set_value('date_of_birth'),
            'nid' => set_value('nid'),
            'social_security_benefit_id' => set_value('social_security_benefit_id'),
            'house_members' => set_value('house_members'),
            'raw_house' => set_value('raw_house'),
            'half_baked_house' => set_value('half_baked_house'),
            'paved_house' => set_value('paved_house'),
            'type_of_infrastructure' => set_value('type_of_infrastructure'),
            'annual_value' => set_value('annual_value'),
            'annual_tax_amount' => set_value('annual_tax_amount'),
            'access_msg' => in_array($this->role_id, [1,2]) ? "<p class='ajax_error'>Only Secetary Can register member </p>" : '',
        );
        $this->viewAdminContent('member/member/create', $data);
    }

    public function create_action()
    {

        // dd($this->input->post());
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            echo ajaxRespond('Fail', validation_errors());
        } else {

            $fiscalYear = $this->input->post('fiscal_year');
            $annualTaxAmount = $this->input->post('annual_tax_amount');
            $currentDepositAmount = $this->input->post('current_deposit_amount');
            $currentDueAmount = $this->input->post('current_due_amount');
            $previousFiscalYearDueAmount = $this->input->post('previous_fiscal_year_due_amount');
            $previousFiscalYear = $this->input->post('previous_fiscal_year');
            $totalDueAmount = $this->input->post('total_due_amount');

            $data = array(
                'union_id' => $this->input->post('union_id', TRUE),
                'present_holding_no' => $this->input->post('present_holding_no', TRUE),
                'word_no' => $this->input->post('word_no', TRUE),
                'village' => $this->input->post('village', TRUE),
                'khana_chief_name_ba' => $this->input->post('khana_chief_name_ba', TRUE),
                'khana_chief_name_en' => $this->input->post('khana_chief_name_en', TRUE),
                'mobile_no' => $this->input->post('mobile_no', TRUE),
                'father_name' => $this->input->post('father_name', TRUE),
                'mother_name' => $this->input->post('mother_name', TRUE),
                'date_of_birth' => $this->input->post('date_of_birth', TRUE),
                'nid' => $this->input->post('nid', TRUE),
                'social_security_benefit_id' => $this->input->post('social_security_benefit_id', TRUE),
                'house_members' => $this->input->post('house_members', TRUE),
                'raw_house' => $this->input->post('raw_house', TRUE),
                'half_baked_house' => $this->input->post('half_baked_house', TRUE),
                'paved_house' => $this->input->post('paved_house', TRUE),
                'type_of_infrastructure' => $this->input->post('type_of_infrastructure', TRUE),
                'created_by' => $this->user_id,
                'created_at' => date('Y-m-d H:i:s'),
            );

            $this->Member_model->insert($data);
            $memberId = $this->db->insert_id();

            $taxAssessmentArr = [];
            if (!empty($fiscalYear)) {
                $i = 0;
                foreach ($fiscalYear as $key => $year) {
                    $taxAssessmentArr[$i++] = [
                        'member_id' => $memberId,
                        'fiscal_year' => $year,
                        'annual_tax_amount' => $annualTaxAmount[$key] ?? null,
                        'current_deposit_amount' => $currentDepositAmount[$key] ?? null,
                        'current_due_amount' => $currentDueAmount[$key] ?? null,
                        'previous_fiscal_year_due_amount' => $previousFiscalYearDueAmount[$key] ?? null,
                        'previous_fiscal_year' => $previousFiscalYear[$key] ?? null,
                        'total_due_amount' => $totalDueAmount[$key] ?? null,
                    ];
                }

                $this->db->insert_batch('member_annual_tax', $taxAssessmentArr);
            }
            echo ajaxRespond('OK', '<p class="ajax_success">Member Added Successfully</p>');
        }
    }

    public function update($id)
    {
        $union_id = getLoginUserData('union_id');
        $union_info = $this->Member_model->getUnionInfoById($union_id);

        $row = $this->Member_model->get_by_id($id);
        $taxAssessments = $this->Member_model->get_member_annual_tax($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url(Backend_URL . 'member/update_action'),
                'role_id' => $this->role_id,
                'id' => set_value('id', $row->id),
                'union_id' => set_value('union_id', $row->union_id),
                'union_name' => $union_info->union_name ?? '',
                'union_bn_name' => $union_info->union_bn_name ?? '',
                'upazilla_id' => $union_info->upazilla_id ?? 0,
                'present_holding_no' => set_value('present_holding_no', $row->present_holding_no),
                'word_no' => set_value('word_no', $row->word_no),
                'village' => set_value('village', $row->village),
                'khana_chief_name_ba' => set_value('khana_chief_name_ba', $row->khana_chief_name_ba),
                'khana_chief_name_en' => set_value('khana_chief_name_en', $row->khana_chief_name_en),
                'mobile_no' => set_value('mobile_no', $row->mobile_no),
                'father_name' => set_value('father_name', $row->father_name),
                'mother_name' => set_value('mother_name', $row->mother_name),
                'date_of_birth' => set_value('date_of_birth', $row->date_of_birth),
                'nid' => set_value('nid', $row->nid),
                'social_security_benefit_id' => set_value('social_security_benefit_id', $row->social_security_benefit_id),
                'house_members' => set_value('house_members', $row->house_members),
                'raw_house' => set_value('raw_house', $row->raw_house),
                'half_baked_house' => set_value('half_baked_house', $row->half_baked_house),
                'paved_house' => set_value('paved_house', $row->paved_house),
                'type_of_infrastructure' => set_value('type_of_infrastructure', $row->type_of_infrastructure),
                'annual_tax_assessments' => $taxAssessments,
                'updated_by' => $this->user_id,
                'updated_at' => date('Y-m-d H:i:s'),
            );
            $this->viewAdminContent('member/member/update', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Member Not Found</p>');
            redirect(site_url(Backend_URL . 'member'));
        }
    }


    public function update_action()
    {

        $this->_rules();

        $id = $this->input->post('id', TRUE);
        if ($this->form_validation->run() == FALSE) {
            echo ajaxRespond('Fail', validation_errors());
        } else {

            $fiscalYear = $this->input->post('fiscal_year');
            $annualTaxAmount = $this->input->post('annual_tax_amount');
            $currentDepositAmount = $this->input->post('current_deposit_amount');
            $currentDueAmount = $this->input->post('current_due_amount');
            $previousFiscalYearDueAmount = $this->input->post('previous_fiscal_year_due_amount');
            $previousFiscalYear = $this->input->post('previous_fiscal_year');
            $totalDueAmount = $this->input->post('total_due_amount');

            $data = array(
                'union_id' => $this->input->post('union_id', TRUE),
                'present_holding_no' => $this->input->post('present_holding_no', TRUE),
                'word_no' => $this->input->post('word_no', TRUE),
                'village' => $this->input->post('village', TRUE),
                'khana_chief_name_ba' => $this->input->post('khana_chief_name_ba', TRUE),
                'khana_chief_name_en' => $this->input->post('khana_chief_name_en', TRUE),
                'mobile_no' => $this->input->post('mobile_no', TRUE),
                'father_name' => $this->input->post('father_name', TRUE),
                'mother_name' => $this->input->post('mother_name', TRUE),
                'date_of_birth' => $this->input->post('date_of_birth', TRUE),
                'nid' => $this->input->post('nid', TRUE),
                'social_security_benefit_id' => $this->input->post('social_security_benefit_id', TRUE),
                'house_members' => $this->input->post('house_members', TRUE),
                'raw_house' => $this->input->post('raw_house', TRUE),
                'half_baked_house' => $this->input->post('half_baked_house', TRUE),
                'paved_house' => $this->input->post('paved_house', TRUE),
                'type_of_infrastructure' => $this->input->post('type_of_infrastructure', TRUE),
                'updated_by' => $this->user_id,
                'updated_at' => date('Y-m-d H:i:s'),
            );

            $this->Member_model->update($id, $data);
            $this->Member_model->delete_annual_tax($id);

            $taxAssessmentArr = [];
            if (!empty($fiscalYear)) {
                $i = 0;
                foreach ($fiscalYear as $key => $year) {
                    $taxAssessmentArr[$i++] = [
                        'member_id' => $id,
                        'fiscal_year' => $year,
                        'annual_tax_amount' => $annualTaxAmount[$key] ?? null,
                        'current_deposit_amount' => $currentDepositAmount[$key] ?? null,
                        'current_due_amount' => $currentDueAmount[$key] ?? null,
                        'previous_fiscal_year_due_amount' => $previousFiscalYearDueAmount[$key] ?? null,
                        'previous_fiscal_year' => $previousFiscalYear[$key] ?? null,
                        'total_due_amount' => $totalDueAmount[$key] ?? null,
                    ];
                }

                $this->db->insert_batch('member_annual_tax', $taxAssessmentArr);
            }
            echo ajaxRespond('OK', '<p class="ajax_success">Member Updated Successlly</p>');
        }
    }


    public function delete($id)
    {
        $row = $this->Member_model->get_by_id($id);
        $taxAssessments = $this->Member_model->get_member_annual_tax($id);

        if ($row) {
            $data = array(
                'id' => $row->id,
                'division_name' => $row->division_name,
                'district_name' => $row->district_name,
                'upazila_name' => $row->upazila_name,
                'union_name' => $row->union_name,
                'present_holding_no' => $row->present_holding_no,
                'word_no' => $row->word_no,
                'village' => $row->village,
                'khana_chief_name_ba' => $row->khana_chief_name_ba,
                'khana_chief_name_en' => $row->khana_chief_name_en,
                'mobile_no' => $row->mobile_no,
                'father_name' => $row->father_name,
                'mother_name' => $row->mother_name,
                'date_of_birth' => $row->date_of_birth,
                'nid' => $row->nid,
                'social_security_benefit_name' => $row->ssb_name,
                'house_members' => $row->house_members,
                'raw_house' => $row->raw_house,
                'half_baked_house' => $row->half_baked_house,
                'paved_house' => $row->paved_house,
                'type_of_infrastructure' => $row->type_of_infrastructure,
                'annual_tax_assessments' => $taxAssessments,
                'created_by' => $row->created_by,
                'updated_by' => $row->updated_by,
                'created_at' => $row->created_at,
                'updated_at' => $row->updated_at,
            );
            $this->viewAdminContent('member/member/delete', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Member Not Found</p>');
            redirect(site_url(Backend_URL . 'member'));
        }
    }

    public function delete_action($id)
    {
        $row = $this->Member_model->get_by_id($id);

        if ($row) {
            $this->Member_model->delete_member_relative($id);
            $this->Member_model->delete($id);
            $this->session->set_flashdata('message', '<p class="ajax_success">Member Deleted Successfully</p>');
            redirect(site_url(Backend_URL . 'member'));
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Member Not Found</p>');
            redirect(site_url(Backend_URL . 'member'));
        }
    }

    public function tax($id)
    {

        $row = $this->Member_model->get_by_id($id);
        $taxAssessments = $this->Member_model->get_member_annual_tax($id);

        if ($row) {
            $data = array(
                'button' => 'Update Tax Assessment',
                'action' => site_url(Backend_URL . 'member/update_tax_action'),
                'role_id' => $this->role_id,
                'id' => set_value('id', $row->id),
                'annual_tax_assessments' => $taxAssessments,
            );
            $this->viewAdminContent('member/member/tax', $data);
        } else {
            $this->session->set_flashdata('message', '<p class="ajax_error">Member Not Found</p>');
            redirect(site_url(Backend_URL . 'member'));
        }
    }

    public function update_tax_action()
    {
        $id = $this->input->post('id', TRUE);
        $fiscalYear = $this->input->post('fiscal_year');
        $annualTaxAmount = $this->input->post('annual_tax_amount');
        $currentDepositAmount = $this->input->post('current_deposit_amount');
        $currentDueAmount = $this->input->post('current_due_amount');
        $previousFiscalYearDueAmount = $this->input->post('previous_fiscal_year_due_amount');
        $previousFiscalYear = $this->input->post('previous_fiscal_year');
        $totalDueAmount = $this->input->post('total_due_amount');

        $this->Member_model->delete_annual_tax($id);

        $taxAssessmentArr = [];
        if (!empty($fiscalYear)) {
            $i = 0;
            foreach ($fiscalYear as $key => $year) {
                $taxAssessmentArr[$i++] = [
                    'member_id' => $id,
                    'fiscal_year' => $year,
                    'annual_tax_amount' => $annualTaxAmount[$key] ?? null,
                    'current_deposit_amount' => $currentDepositAmount[$key] ?? null,
                    'current_due_amount' => $currentDueAmount[$key] ?? null,
                    'previous_fiscal_year_due_amount' => $previousFiscalYearDueAmount[$key] ?? null,
                    'previous_fiscal_year' => $previousFiscalYear[$key] ?? null,
                    'total_due_amount' => $totalDueAmount[$key] ?? null,
                ];
            }

            $this->db->insert_batch('member_annual_tax', $taxAssessmentArr);
        }
        echo ajaxRespond('OK', '<p class="ajax_success">Member Annual Tax Assessment Updated Successlly</p>');
    }

    public function _menu()
    {
        // return add_main_menu('Member', 'member', 'member', 'fa-hand-o-right');
        return buildMenuForMoudle([
            'module' => 'Member',
            'icon' => 'fa-hand-o-right',
            'href' => 'member',
            'children' => [
                [
                    'title' => 'All Member',
                    'icon' => 'fa fa-bars',
                    'href' => 'member',
                ],[
                    'title' => ' |_ Add New',
                    'icon' => 'fa fa-plus',
                    'href' => 'member/create',
                ],[
                    'title' => 'Summary',
                    'icon' => 'fa fa-bars',
                    'href' => 'member/summary',
                ],
            ],
        ]);
    }

    public function _rules()
    {
        $this->form_validation->set_rules('union_id', 'union id', 'trim|required|numeric', array('required' => '????????????????????? ???????????????????????? ???????????? ?????????!'));
        $this->form_validation->set_rules('present_holding_no', 'present holding no', 'trim|required', array('required' => '????????????????????? ????????????????????? ????????????????????? ?????????????????? ???????????? ???????????? ?????????!'));
        $this->form_validation->set_rules('word_no', 'word no', 'trim|required', array('required' => '?????????????????? ?????? ?????????????????? ???????????? ???????????? ?????????!'));
        $this->form_validation->set_rules('village', 'village', 'trim|required', array('required' => '???????????????/????????????????????? ????????? ?????????????????? ???????????? ???????????? ?????????!'));
        $this->form_validation->set_rules('khana_chief_name_ba', 'khana chief name ba', 'trim|required', array('required' => '???????????? ???????????????????????? ????????? (??????????????????) ?????????????????? ???????????? ???????????? ?????????!'));
        $this->form_validation->set_rules('khana_chief_name_en', 'khana chief name en', 'trim|required', array('required' => '???????????? ???????????????????????? ????????? (????????????????????????) ?????????????????? ???????????? ???????????? ?????????!'));
        $this->form_validation->set_rules('father_name', 'father name', 'trim|required', array('required' => '????????????/????????????????????? ????????? ?????????????????? ???????????? ???????????? ?????????!'));
        $this->form_validation->set_rules('mother_name', 'mother name', 'trim|required', array('required' => '??????????????? ????????? ?????????????????? ???????????? ???????????? ?????????!'));
        $this->form_validation->set_rules('date_of_birth', 'date of birth', 'trim|required', array('required' => '???????????? ??????????????? ?????????????????? ???????????? ???????????? ?????????!'));
        $this->form_validation->set_rules('social_security_benefit_id', 'social security benefit id', 'trim|required|numeric', array('required' => '?????????????????? ??????????????????????????????/???????????? ????????????????????? ?????? ?????????????????? ???????????? ???????????? ?????????!'));
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
    }
}
