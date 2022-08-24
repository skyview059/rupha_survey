<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* Author: Khairul Azam
 * Date : 2022-08-21
 */

class Member extends Admin_controller {
	function __construct() {
		parent::__construct();
		$this->load->model('Member_model');
		$this->load->helper('member');
		$this->load->library('form_validation');
	}

	public function index() {
		
		$q = urldecode($this->input->get('q', TRUE));
		$division_id = $this->input->get('division_id', TRUE);
		$district_id = $this->input->get('district_id', TRUE);
		$upazilla_id = $this->input->get('upazilla_id', TRUE);
		$union_id = $this->input->get('union_id', TRUE);
		$start = intval($this->input->get('start'));

		$config['base_url'] = build_pagination_url(Backend_URL . 'member/', 'start');
		$config['first_url'] = build_pagination_url(Backend_URL . 'member/', 'start');

		$config['per_page'] = 25;
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->Member_model->total_rows($q, $division_id, $district_id, $upazilla_id, $union_id);
		$members = $this->Member_model->get_limit_data($config['per_page'], $start, $q, $division_id, $district_id, $upazilla_id, $union_id);

		$this->load->library('pagination');
		$this->pagination->initialize($config);

		$data = array(
			'members' => $members,
			'role_id' => $this->role_id,
			'division_id' => $division_id,
            'district_id' => $district_id,
            'upazilla_id' => $upazilla_id,
            'union_id' => $union_id,
			'q' => $q,
			'pagination' => $this->pagination->create_links(),
			'total_rows' => $config['total_rows'],
			'start' => $start,
		);
		$this->viewAdminContent('member/member/index', $data);
	}

	public function read($id) {
		
		$row = $this->Member_model->get_by_id($id);
		if ($row) {
			$data = array(
				'id' => $row->id,
				'division_name' => $row->division_name,
				'district_name' => $row->district_name,
				'upazila_name' => $row->upazila_name,
				'union_name' => $row->union_name,
				'previous_holding_no' => $row->previous_holding_no,
				'present_holding_no' => $row->present_holding_no,
				'word_no' => $row->word_no,
				'village' => $row->village,
				'khana_chief_name_ba' => $row->khana_chief_name_ba,
				'khana_chief_name_en' => $row->khana_chief_name_en,
				'mobile_no' => $row->mobile_no,
				'avg_annual_income' => $row->avg_annual_income,
				'father_name' => $row->father_name,
				'mother_name' => $row->mother_name,
				'date_of_birth' => $row->date_of_birth,
				'nid' => $row->nid,
				'social_security_benefit_name' => $row->ssb_name,
				'income_source_name' => $row->income_source_name,
				'house_members' => $row->house_members,
				'male' => $row->male,
				'female' => $row->female,
				'adult' => $row->adult,
				'infant' => $row->infant,
				'tube_well' => $row->tube_well,
				'latrine' => $row->latrine,
				'disabled_member_name' => $row->disabled_member_name,
				'disabled_member_age' => $row->disabled_member_age,
				'type_of_disability' => $row->type_of_disability,
				'expatriate_name' => $row->expatriate_name,
				'country_name' => $row->country_name,
				'asset_type_name' => $row->asset_type_name,
				'description' => $row->description,
				'raw_house' => $row->raw_house,
				'half_baked_house' => $row->half_baked_house,
				'paved_house' => $row->paved_house,
				'type_of_infrastructure' => $row->type_of_infrastructure,
				'annual_value' => $row->annual_value,
				'annual_tax_amount' => $row->annual_tax_amount,
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

	public function create() {
		$data = array(
			'button' => 'Create',
			'action' => site_url(Backend_URL . 'member/create_action'),
			'id' => set_value('id'),
			'union_id' => set_value('union_id'),
			'previous_holding_no' => set_value('previous_holding_no'),
			'present_holding_no' => set_value('present_holding_no'),
			'word_no' => set_value('word_no'),
			'village' => set_value('village'),
			'khana_chief_name_ba' => set_value('khana_chief_name_ba'),
			'khana_chief_name_en' => set_value('khana_chief_name_en'),
			'mobile_no' => set_value('mobile_no'),
			'avg_annual_income' => set_value('avg_annual_income'),
			'father_name' => set_value('father_name'),
			'mother_name' => set_value('mother_name'),
			'date_of_birth' => set_value('date_of_birth'),
			'nid' => set_value('nid'),
			'social_security_benefit_id' => set_value('social_security_benefit_id'),
			'income_source_id' => set_value('income_source_id'),
			'house_members' => set_value('house_members'),
			'male' => set_value('male'),
			'female' => set_value('female'),
			'adult' => set_value('adult'),
			'infant' => set_value('infant'),
			'tube_well' => set_value('tube_well'),
			'latrine' => set_value('latrine'),
			'disabled_member_name' => set_value('disabled_member_name'),
			'disabled_member_age' => set_value('disabled_member_age'),
			'type_of_disability' => set_value('type_of_disability'),
			'expatriate_name' => set_value('expatriate_name'),
			'country_name' => set_value('country_name'),
			'asset_type_id' => set_value('asset_type_id'),
			'description' => set_value('description'),
			'raw_house' => set_value('raw_house'),
			'half_baked_house' => set_value('half_baked_house'),
			'paved_house' => set_value('paved_house'),
			'type_of_infrastructure' => set_value('type_of_infrastructure'),
			'annual_value' => set_value('annual_value'),
			'annual_tax_amount' => set_value('annual_tax_amount'),

		);
		$this->viewAdminContent('member/member/create', $data);
	}

	public function create_action() {

		// dd($this->input->post());
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			echo ajaxRespond('Fail', validation_errors());
		} else {

			$relatives = $this->input->post('relative_name');
			$relativeOccupation = $this->input->post('relative_occupation');
			$relativeRelationship = $this->input->post('relative_relationship');
			$relativeEducationQualification = $this->input->post('relative_educational_qualification');

			$data = array(
				'union_id' => $this->input->post('union_id', TRUE),
				'previous_holding_no' => $this->input->post('previous_holding_no', TRUE),
				'present_holding_no' => $this->input->post('present_holding_no', TRUE),
				'word_no' => $this->input->post('word_no', TRUE),
				'village' => $this->input->post('village', TRUE),
				'khana_chief_name_ba' => $this->input->post('khana_chief_name_ba', TRUE),
				'khana_chief_name_en' => $this->input->post('khana_chief_name_en', TRUE),
				'mobile_no' => $this->input->post('mobile_no', TRUE),
				'avg_annual_income' => $this->input->post('avg_annual_income', TRUE),
				'father_name' => $this->input->post('father_name', TRUE),
				'mother_name' => $this->input->post('mother_name', TRUE),
				'date_of_birth' => $this->input->post('date_of_birth', TRUE),
				'nid' => $this->input->post('nid', TRUE),
				'social_security_benefit_id' => $this->input->post('social_security_benefit_id', TRUE),
				'income_source_id' => $this->input->post('income_source_id', TRUE),
				'house_members' => $this->input->post('house_members', TRUE),
				'male' => $this->input->post('male', TRUE),
				'female' => $this->input->post('female', TRUE),
				'adult' => $this->input->post('adult', TRUE),
				'infant' => $this->input->post('infant', TRUE),
				'tube_well' => $this->input->post('tube_well', TRUE),
				'latrine' => $this->input->post('latrine', TRUE),
				'disabled_member_name' => $this->input->post('disabled_member_name', TRUE),
				'disabled_member_age' => $this->input->post('disabled_member_age', TRUE),
				'type_of_disability' => $this->input->post('type_of_disability', TRUE),
				'expatriate_name' => $this->input->post('expatriate_name', TRUE),
				'country_name' => $this->input->post('country_name', TRUE),
				'asset_type_id' => $this->input->post('asset_type_id', TRUE),
				'description' => $this->input->post('description', TRUE),
				'raw_house' => $this->input->post('raw_house', TRUE),
				'half_baked_house' => $this->input->post('half_baked_house', TRUE),
				'paved_house' => $this->input->post('paved_house', TRUE),
				'type_of_infrastructure' => $this->input->post('type_of_infrastructure', TRUE),
				'annual_value' => $this->input->post('annual_value', TRUE),
				'annual_tax_amount' => $this->input->post('annual_tax_amount', TRUE),
				'created_by' => $this->user_id,
				'created_at' => date('Y-m-d H:i:s'),
			);

			$this->Member_model->insert($data);
			$memberId = $this->db->insert_id();

			$relativeArr = [];
			if(!empty($relatives)){
				$i=0;
				foreach($relatives as $key => $relative){
					$relativeArr[$i++] = [
						'member_id' => $memberId,
						'name' => $relative,
						'occupation' => $relativeOccupation[$key] ?? null,
						'relationship' => $relativeRelationship[$key] ?? null,
						'educational_qualification' => $relativeEducationQualification[$key] ?? null,
					];
	
				}

				$this->db->insert_batch('member_relatives', $relativeArr); 
			}
			echo ajaxRespond('OK', '<p class="ajax_success">Member Added Successfully</p>');
		}
	}

	public function update($id) {
		$row = $this->Member_model->get_by_id($id);
		$relatives = $this->Member_model->get_member_relatives($id);

		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url(Backend_URL . 'member/update_action'),
				'id' => set_value('id', $row->id),
				'union_id' => set_value('union_id', $row->union_id),
				'previous_holding_no' => set_value('previous_holding_no', $row->previous_holding_no),
				'present_holding_no' => set_value('present_holding_no', $row->present_holding_no),
				'word_no' => set_value('word_no', $row->word_no),
				'village' => set_value('village', $row->village),
				'khana_chief_name_ba' => set_value('khana_chief_name_ba', $row->khana_chief_name_ba),
				'khana_chief_name_en' => set_value('khana_chief_name_en', $row->khana_chief_name_en),
				'mobile_no' => set_value('mobile_no', $row->mobile_no),
				'avg_annual_income' => set_value('avg_annual_income', $row->avg_annual_income),
				'father_name' => set_value('father_name', $row->father_name),
				'mother_name' => set_value('mother_name', $row->mother_name),
				'date_of_birth' => set_value('date_of_birth', $row->date_of_birth),
				'nid' => set_value('nid', $row->nid),
				'social_security_benefit_id' => set_value('social_security_benefit_id', $row->social_security_benefit_id),
				'income_source_id' => set_value('income_source_id', $row->income_source_id),
				'house_members' => set_value('house_members', $row->house_members),
				'male' => set_value('male', $row->male),
				'female' => set_value('female', $row->female),
				'adult' => set_value('adult', $row->adult),
				'infant' => set_value('infant', $row->infant),
				'tube_well' => set_value('tube_well', $row->tube_well),
				'latrine' => set_value('latrine', $row->latrine),
				'disabled_member_name' => set_value('disabled_member_name', $row->disabled_member_name),
				'disabled_member_age' => set_value('disabled_member_age', $row->disabled_member_age),
				'type_of_disability' => set_value('type_of_disability', $row->type_of_disability),
				'expatriate_name' => set_value('expatriate_name', $row->expatriate_name),
				'country_name' => set_value('country_name', $row->country_name),
				'asset_type_id' => set_value('asset_type_id', $row->asset_type_id),
				'description' => set_value('description', $row->description),
				'raw_house' => set_value('raw_house', $row->raw_house),
				'half_baked_house' => set_value('half_baked_house', $row->half_baked_house),
				'paved_house' => set_value('paved_house', $row->paved_house),
				'type_of_infrastructure' => set_value('type_of_infrastructure', $row->type_of_infrastructure),
				'annual_value' => set_value('annual_value', $row->annual_value),
				'annual_tax_amount' => set_value('annual_tax_amount', $row->annual_tax_amount),
				'relatives' => $relatives,
				'updated_by' => $this->user_id,
				'updated_at' => date('Y-m-d H:i:s'),
			);
			$this->viewAdminContent('member/member/update', $data);
		} else {
			$this->session->set_flashdata('message', '<p class="ajax_error">Member Not Found</p>');
			redirect(site_url(Backend_URL . 'member'));
		}
	}

	public function update_action() {
		
		$this->_rules();

		$id = $this->input->post('id', TRUE);
		if ($this->form_validation->run() == FALSE) {
			echo ajaxRespond('Fail', validation_errors());
		} else {
			$relatives = $this->input->post('relative_name');
			$relativeOccupation = $this->input->post('relative_occupation');
			$relativeRelationship = $this->input->post('relative_relationship');
			$relativeEducationQualification = $this->input->post('relative_educational_qualification');

			$data = array(
				'union_id' => $this->input->post('union_id', TRUE),
				'previous_holding_no' => $this->input->post('previous_holding_no', TRUE),
				'present_holding_no' => $this->input->post('present_holding_no', TRUE),
				'word_no' => $this->input->post('word_no', TRUE),
				'village' => $this->input->post('village', TRUE),
				'khana_chief_name_ba' => $this->input->post('khana_chief_name_ba', TRUE),
				'khana_chief_name_en' => $this->input->post('khana_chief_name_en', TRUE),
				'mobile_no' => $this->input->post('mobile_no', TRUE),
				'avg_annual_income' => $this->input->post('avg_annual_income', TRUE),
				'father_name' => $this->input->post('father_name', TRUE),
				'mother_name' => $this->input->post('mother_name', TRUE),
				'date_of_birth' => $this->input->post('date_of_birth', TRUE),
				'nid' => $this->input->post('nid', TRUE),
				'social_security_benefit_id' => $this->input->post('social_security_benefit_id', TRUE),
				'income_source_id' => $this->input->post('income_source_id', TRUE),
				'house_members' => $this->input->post('house_members', TRUE),
				'male' => $this->input->post('male', TRUE),
				'female' => $this->input->post('female', TRUE),
				'adult' => $this->input->post('adult', TRUE),
				'infant' => $this->input->post('infant', TRUE),
				'tube_well' => $this->input->post('tube_well', TRUE),
				'latrine' => $this->input->post('latrine', TRUE),
				'disabled_member_name' => $this->input->post('disabled_member_name', TRUE),
				'disabled_member_age' => $this->input->post('disabled_member_age', TRUE),
				'type_of_disability' => $this->input->post('type_of_disability', TRUE),
				'expatriate_name' => $this->input->post('expatriate_name', TRUE),
				'country_name' => $this->input->post('country_name', TRUE),
				'asset_type_id' => $this->input->post('asset_type_id', TRUE),
				'description' => $this->input->post('description', TRUE),
				'raw_house' => $this->input->post('raw_house', TRUE),
				'half_baked_house' => $this->input->post('half_baked_house', TRUE),
				'paved_house' => $this->input->post('paved_house', TRUE),
				'type_of_infrastructure' => $this->input->post('type_of_infrastructure', TRUE),
				'annual_value' => $this->input->post('annual_value', TRUE),
				'annual_tax_amount' => $this->input->post('annual_tax_amount', TRUE),
				'updated_by' => $this->user_id,
				'updated_at' => date('Y-m-d H:i:s'),
			);
			
			$this->Member_model->update($id, $data);
			$this->Member_model->delete_member_relative($id);
			
			$relativeArr = [];
			if(!empty($relatives)){
				$i=0;
				foreach($relatives as $key => $relative){
					$relativeArr[$i++] = [
						'member_id' => $id,
						'name' => $relative,
						'occupation' => $relativeOccupation[$key] ?? null,
						'relationship' => $relativeRelationship[$key] ?? null,
						'educational_qualification' => $relativeEducationQualification[$key] ?? null,
					];
	
				}

				$this->db->insert_batch('member_relatives', $relativeArr); 
			}
			echo ajaxRespond('OK', '<p class="ajax_success">Member Updated Successlly</p>');
		}
	}

	public function delete($id) {
		$row = $this->Member_model->get_by_id($id);
		if ($row) {
			$data = array(
				'id' => $row->id,
				'division_name' => $row->division_name,
				'district_name' => $row->district_name,
				'upazila_name' => $row->upazila_name,
				'union_name' => $row->union_name,
				'previous_holding_no' => $row->previous_holding_no,
				'present_holding_no' => $row->present_holding_no,
				'word_no' => $row->word_no,
				'village' => $row->village,
				'khana_chief_name_ba' => $row->khana_chief_name_ba,
				'khana_chief_name_en' => $row->khana_chief_name_en,
				'mobile_no' => $row->mobile_no,
				'avg_annual_income' => $row->avg_annual_income,
				'father_name' => $row->father_name,
				'mother_name' => $row->mother_name,
				'date_of_birth' => $row->date_of_birth,
				'nid' => $row->nid,
				'social_security_benefit_name' => $row->ssb_name,
				'income_source_name' => $row->income_source_name,
				'house_members' => $row->house_members,
				'male' => $row->male,
				'female' => $row->female,
				'adult' => $row->adult,
				'infant' => $row->infant,
				'tube_well' => $row->tube_well,
				'latrine' => $row->latrine,
				'disabled_member_name' => $row->disabled_member_name,
				'disabled_member_age' => $row->disabled_member_age,
				'type_of_disability' => $row->type_of_disability,
				'expatriate_name' => $row->expatriate_name,
				'country_name' => $row->country_name,
				'asset_type_name' => $row->asset_type_name,
				'description' => $row->description,
				'raw_house' => $row->raw_house,
				'half_baked_house' => $row->half_baked_house,
				'paved_house' => $row->paved_house,
				'type_of_infrastructure' => $row->type_of_infrastructure,
				'annual_value' => $row->annual_value,
				'annual_tax_amount' => $row->annual_tax_amount,
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

	public function delete_action($id) {
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

	public function _menu() {
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
				], [
					'title' => ' |_ Add New',
					'icon' => 'fa fa-plus',
					'href' => 'member/create',
				],
			],
		]);
	}

	public function _rules() {
		$this->form_validation->set_rules('union_id', 'union id', 'trim|required|numeric', array('required' => 'ইউনিয়ন নির্বাচন করতে হবে!'));
		$this->form_validation->set_rules('previous_holding_no', 'previous holding no', 'trim|required', array('required' => 'পূর্ববর্তী হোল্ডিং নাম্বার অবশ্যই পূরণ করতে হবে!'));
		$this->form_validation->set_rules('present_holding_no', 'present holding no', 'trim|required', array('required' => 'বর্তমান হোল্ডিং নাম্বার অবশ্যই পূরণ করতে হবে!'));
		$this->form_validation->set_rules('word_no', 'word no', 'trim|required', array('required' => 'ওয়ার্ড নং অবশ্যই পূরণ করতে হবে!'));
		$this->form_validation->set_rules('village', 'village', 'trim|required', array('required' => 'গ্রাম/মহল্লার নাম অবশ্যই পূরণ করতে হবে!'));
		$this->form_validation->set_rules('khana_chief_name_ba', 'khana chief name ba', 'trim|required', array('required' => 'খানা প্রধানের নাম (বাংলায়) অবশ্যই পূরণ করতে হবে!'));
		$this->form_validation->set_rules('khana_chief_name_en', 'khana chief name en', 'trim|required', array('required' => 'খানা প্রধানের নাম (ইংরেজিতে) অবশ্যই পূরণ করতে হবে!'));
		$this->form_validation->set_rules('father_name', 'father name', 'trim|required', array('required' => 'পিতা/স্বামীর নাম অবশ্যই পূরণ করতে হবে!'));
		$this->form_validation->set_rules('mother_name', 'mother name', 'trim|required', array('required' => 'মাতার নাম অবশ্যই পূরণ করতে হবে!'));
		$this->form_validation->set_rules('date_of_birth', 'date of birth', 'trim|required', array('required' => 'জন্ম তারিখ অবশ্যই পূরণ করতে হবে!'));
		$this->form_validation->set_rules('social_security_benefit_id', 'social security benefit id', 'trim|required|numeric', array('required' => 'জাতীয় পরিচয়পত্র/জন্ম নিবন্ধন নং অবশ্যই পূরণ করতে হবে!'));
		$this->form_validation->set_rules('income_source_id', 'income source id', 'trim|required|numeric', array('required' => 'সামাজিক সুরক্ষার সুবিধা নির্বাচন করতে হবে!'));
		$this->form_validation->set_rules('tube_well', 'tube well', 'trim|required', array('required' => 'নলকূপ নির্বাচন করতে হবে!'));
		$this->form_validation->set_rules('latrine', 'latrine', 'trim|required', array('required' => 'ল্যাট্রিন নির্বাচন করতে হবে!'));
		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
	}

}