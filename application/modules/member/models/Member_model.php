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
		}
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
		$this->db->select('members.*, u.bn_name as union_name, bd_upazilas.bn_name as upazila_name, bd_districts.bn_name as district_name, bd_divisions.bn_name as division_name');
		$this->db->select('ssb.name_ba as ssb_name, is.name_ba as income_source_name');
		$this->db->join('bd_unions as u', 'u.id = members.union_id', 'left');
		$this->db->join('bd_upazilas', 'bd_upazilas.id = u.upazilla_id', 'left');
		$this->db->join('bd_districts', 'bd_districts.id = bd_upazilas.district_id', 'left');
		$this->db->join('bd_divisions', 'bd_divisions.id = bd_districts.division_id', 'left');
		$this->db->join('social_security_benefits as ssb', 'ssb.id = members.social_security_benefit_id', 'left');
		$this->db->join('income_sources as is', 'is.id = members.income_source_id', 'left');
		$this->db->join('asset_types as at', 'at.id = members.asset_type_id', 'left');
        $this->db->order_by($this->id, $this->order);
        if($q){
			$this->db->like('members.id', $q);
			$this->db->or_like('members.union_id', $q);
			$this->db->or_like('members.previous_holding_no', $q);
			$this->db->or_like('members.present_holding_no', $q);
			$this->db->or_like('members.word_no', $q);
			$this->db->or_like('members.village', $q);
			$this->db->or_like('members.khana_chief_name_ba', $q);
			$this->db->or_like('members.khana_chief_name_en', $q);
			$this->db->or_like('members.mobile_no', $q);
			$this->db->or_like('members.avg_annual_income', $q);
			$this->db->or_like('members.father_name', $q);
			$this->db->or_like('members.mother_name', $q);
			$this->db->or_like('members.date_of_birth', $q);
			$this->db->or_like('members.social_security_benefit_id', $q);
			$this->db->or_like('members.income_source_id', $q);
			$this->db->or_like('members.house_members', $q);
			$this->db->or_like('members.male', $q);
			$this->db->or_like('members.female', $q);
			$this->db->or_like('members.adult', $q);
			$this->db->or_like('members.infant', $q);
			$this->db->or_like('members.tube_well', $q);
			$this->db->or_like('members.latrine', $q);
			$this->db->or_like('members.disabled_member_name', $q);
			$this->db->or_like('members.disabled_member_age', $q);
			$this->db->or_like('members.type_of_disability', $q);
			$this->db->or_like('members.expatriate_name', $q);
			$this->db->or_like('members.country_name', $q);
			$this->db->or_like('members.asset_type_id', $q);
			$this->db->or_like('members.description', $q);
			$this->db->or_like('members.raw_house', $q);
			$this->db->or_like('members.half_baked_house', $q);
			$this->db->or_like('members.paved_house', $q);
			$this->db->or_like('members.type_of_infrastructure', $q);
			$this->db->or_like('members.annual_value', $q);
			$this->db->or_like('members.annual_tax_amount', $q);
		}
		$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

	function get_by_id($id){
        
		$this->db->select('m.*, u.bn_name as union_name, bd_upazilas.bn_name as upazila_name, bd_districts.bn_name as district_name, bd_divisions.bn_name as division_name');
		$this->db->select('ssb.name_ba as ssb_name, is.name_ba as income_source_name, at.name_ba as asset_type_name');
		$this->db->from("{$this->table} as m");
		$this->db->join('bd_unions as u', 'u.id = m.union_id', 'left');
		$this->db->join('bd_upazilas', 'bd_upazilas.id = u.upazilla_id', 'left');
		$this->db->join('bd_districts', 'bd_districts.id = bd_upazilas.district_id', 'left');
		$this->db->join('bd_divisions', 'bd_divisions.id = bd_districts.division_id', 'left');
		$this->db->join('social_security_benefits as ssb', 'ssb.id = m.social_security_benefit_id', 'left');
		$this->db->join('income_sources as is', 'is.id = m.income_source_id', 'left');
		$this->db->join('asset_types as at', 'at.id = m.asset_type_id', 'left');
        $this->db->where('m.id', $id);
        return $this->db->get()->row();
    }

	function get_member_relatives($member_id)
	{
		$this->db->from("member_relatives")->where('member_id', $member_id);
		return $this->db->get()->result();
	}

	function delete_member_relative($member_id)
	{
		$this->db->where('member_id', $member_id);
		if($this->db->delete('member_relatives')){
			return true;
		}else{
			return false;
		}
	}
    

}