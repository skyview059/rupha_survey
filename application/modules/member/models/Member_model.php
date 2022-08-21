<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class Member_model extends Fm_model{

    public $table = 'members';
    public $id = 'id';
    public $order = 'DESC';

    function __construct(){
        parent::__construct();
    }    
    
    // get total rows
    function total_rows($q = NULL) {
    
    if($q){
        	$this->db->like('id', $q);
		$this->db->or_like('union_id', $q);
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
		$this->db->or_like('created_by', $q);
		$this->db->or_like('updated_by', $q);
		$this->db->or_like('created_at', $q);
		$this->db->or_like('updated_at', $q);
	}
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        if($q){
        	$this->db->like('id', $q);
		$this->db->or_like('union_id', $q);
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
		$this->db->or_like('created_by', $q);
		$this->db->or_like('updated_by', $q);
		$this->db->or_like('created_at', $q);
		$this->db->or_like('updated_at', $q);
	}
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
    

}