<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class DBR_model extends Fm_model{

    public $table = 'members';
    public $id = 'id';
    public $order = 'DESC';

    function __construct(){
        parent::__construct();
    }    
    
    // get total rows
    function total_rows($q = NULL, $division_id = null, $district_id = null, $upazilla_id = null, $union_id = null) {
		
		if(!empty($this->input->get('id', TRUE))){
			$this->db->where('members.created_by', $this->input->get('id', TRUE));
		}
		
		if(in_array($this->role_id, [3,4])){
			$union_id = getLoginUserData('union_id');
			
			$this->db->where('members.union_id', $union_id);
		}

		if(!empty($division_id)){
			$this->db->where('bd_divisions.id', $division_id);
		}

		if(!empty($district_id)){
			$this->db->where('bd_districts.id', $district_id);
		}

		if(!empty($upazilla_id)){
			$this->db->where('bd_upazilas.id', $upazilla_id);
		}

		if(!empty($union_id)){
			$this->db->where('u.id', $union_id);
		}

		if($q){
			$this->db->like('id', $q);
			$this->db->or_like('previous_holding_no', $q);
			$this->db->or_like('present_holding_no', $q);
			$this->db->or_like('word_no', $q);
			$this->db->or_like('village', $q);
			$this->db->or_like('khana_chief_name_ba', $q);
			$this->db->or_like('khana_chief_name_en', $q);
			$this->db->or_like('mobile_no', $q);
			$this->db->or_like('avg_annual_income', $q);
			$this->db->or_like('father_name', $q);
			$this->db->or_like('mother_name', $q);
			$this->db->or_like('date_of_birth', $q);
			$this->db->or_like('social_security_benefit_id', $q);
			$this->db->or_like('income_source_id', $q);
			$this->db->or_like('house_members', $q);
			$this->db->or_like('male', $q);
			$this->db->or_like('female', $q);
			$this->db->or_like('adult', $q);
			$this->db->or_like('infant', $q);
			$this->db->or_like('tube_well', $q);
			$this->db->or_like('latrine', $q);
			$this->db->or_like('disabled_member_name', $q);
			$this->db->or_like('disabled_member_age', $q);
			$this->db->or_like('type_of_disability', $q);
			$this->db->or_like('expatriate_name', $q);
			$this->db->or_like('country_name', $q);
			$this->db->or_like('asset_type_id', $q);
			$this->db->or_like('description', $q);
			$this->db->or_like('raw_house', $q);
			$this->db->or_like('half_baked_house', $q);
			$this->db->or_like('paved_house', $q);
			$this->db->or_like('type_of_infrastructure', $q);
			$this->db->or_like('annual_value', $q);
			$this->db->or_like('annual_tax_amount', $q);
		}
		$this->db->from($this->table);
		$this->db->join('bd_unions as u', 'u.id = members.union_id', 'left');
		$this->db->join('bd_upazilas', 'bd_upazilas.id = u.upazilla_id', 'left');
		$this->db->join('bd_districts', 'bd_districts.id = bd_upazilas.district_id', 'left');
		$this->db->join('bd_divisions', 'bd_divisions.id = bd_districts.division_id', 'left');
		$this->db->join('users', 'users.id = members.created_by', 'left');

        return $this->db->count_all_results();
    }

    
}