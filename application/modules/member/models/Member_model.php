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
    function total_rows($q = NULL, $division_id = null, $district_id = null, $upazilla_id = null, $union_id = null, $user_id = null) {
		
		
		if(in_array($this->role_id, [3,4])){
			$union_id = getLoginUserData('union_id');
			$this->db->where('members.union_id', $union_id);
			$this->db->where('members.created_by', $this->user_id);
		}else{
			if(!empty($user_id)){
				$this->db->where('members.created_by', $user_id);
			}
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
			$this->db->or_like('members.present_holding_no', $q);
			$this->db->or_like('members.nid', $q);
			$this->db->or_like('members.mobile_no', $q);
			$this->db->or_like('members.word_no', $q);
			$this->db->or_like('members.village', $q);
			$this->db->or_like('members.khana_chief_name_ba', $q);
			$this->db->or_like('members.khana_chief_name_en', $q);
			$this->db->or_like('members.date_of_birth', $q);
		}
		$this->db->from($this->table);
		$this->db->join('bd_unions as u', 'u.id = members.union_id', 'left');
		$this->db->join('bd_upazilas', 'bd_upazilas.id = u.upazilla_id', 'left');
		$this->db->join('bd_districts', 'bd_districts.id = bd_upazilas.district_id', 'left');
		$this->db->join('bd_divisions', 'bd_divisions.id = bd_districts.division_id', 'left');
		$this->db->join('users', 'users.id = members.created_by', 'left');

        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL, $division_id = null, $district_id = null, $upazilla_id = null, $union_id = null, $user_id=null) {
		
		$this->db->select('members.*, u.bn_name as union_name, bd_upazilas.bn_name as upazila_name, bd_districts.bn_name as district_name, bd_divisions.bn_name as division_name');
		$this->db->select('ssb.name_ba as ssb_name, is.name_ba as income_source_name');
		$this->db->select('users.full_name');
		$this->db->join('bd_unions as u', 'u.id = members.union_id', 'left');
		$this->db->join('bd_upazilas', 'bd_upazilas.id = u.upazilla_id', 'left');
		$this->db->join('bd_districts', 'bd_districts.id = bd_upazilas.district_id', 'left');
		$this->db->join('bd_divisions', 'bd_divisions.id = bd_districts.division_id', 'left');
		$this->db->join('social_security_benefits as ssb', 'ssb.id = members.social_security_benefit_id', 'left');
		$this->db->join('income_sources as is', 'is.id = members.income_source_id', 'left');
		$this->db->join('asset_types as at', 'at.id = members.asset_type_id', 'left');
		$this->db->join('users', 'users.id = members.created_by', 'left');
        $this->db->order_by($this->id, $this->order);

		if(in_array($this->role_id, [3,4])){
			$union_id = getLoginUserData('union_id');
			$this->db->where('members.union_id', $union_id);
			$this->db->where('members.created_by', $this->user_id);
		}else{
			if(!empty($user_id)){
				$this->db->where('members.created_by', $user_id);
			}
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
			$this->db->group_start();
			$this->db->like('members.id', $q);
			$this->db->or_like('members.present_holding_no', $q);
			$this->db->or_like('members.nid', $q);
			$this->db->or_like('members.mobile_no', $q);
			$this->db->or_like('members.word_no', $q);
			$this->db->or_like('members.village', $q);
			$this->db->or_like('members.khana_chief_name_ba', $q);
			$this->db->or_like('members.khana_chief_name_en', $q);
			$this->db->or_like('members.date_of_birth', $q);
			$this->db->group_end();
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
		if(in_array($this->role_id, [3,4])){
			$union_id = getLoginUserData('union_id');
			$this->db->where('m.union_id', $union_id);
		}

        return $this->db->get()->row();
    }

	function get_member_annual_tax_assessments($member_id)
	{
		$this->db->from("member_annual_tax_assessments")->where('member_id', $member_id);
		return $this->db->get()->result();
	}

	function delete_annual_tax_assessment($member_id)
	{
		$this->db->where('member_id', $member_id);
		if($this->db->delete('member_annual_tax_assessments')){
			return true;
		}else{
			return false;
		}
	}

	public function get_latest_members($limit)
	{

		$this->db->select('members.*, u.bn_name as union_name, bd_upazilas.bn_name as upazila_name, bd_districts.bn_name as district_name, bd_divisions.bn_name as division_name');
		$this->db->select('ssb.name_ba as ssb_name, is.name_ba as income_source_name');
		$this->db->select('users.full_name');
		$this->db->join('bd_unions as u', 'u.id = members.union_id', 'left');
		$this->db->join('bd_upazilas', 'bd_upazilas.id = u.upazilla_id', 'left');
		$this->db->join('bd_districts', 'bd_districts.id = bd_upazilas.district_id', 'left');
		$this->db->join('bd_divisions', 'bd_divisions.id = bd_districts.division_id', 'left');
		$this->db->join('social_security_benefits as ssb', 'ssb.id = members.social_security_benefit_id', 'left');
		$this->db->join('income_sources as is', 'is.id = members.income_source_id', 'left');
		$this->db->join('asset_types as at', 'at.id = members.asset_type_id', 'left');
		$this->db->join('users', 'users.id = members.created_by', 'left');
		$this->db->order_by('members.id', 'DESC');

		if(in_array($this->role_id, [3,4])){
			$union_id = getLoginUserData('union_id');
			$this->db->where('members.union_id', $union_id);
		}
		$this->db->limit($limit);

        $members = $this->db->get('members')->result();
		return $members;
	}

	public function getUnionInfoById($id)
	{
		$this->db->select('u.*, u.name as union_name, u.bn_name as union_bn_name, bd_upazilas.name as upazila_name, bd_upazilas.bn_name as upazila_bn_name, bd_districts.name as district_name, bd_districts.bn_name as district_bn_name, bd_divisions.name as division_name, bd_divisions.bn_name as division_bn_name');
		$this->db->join('bd_upazilas', 'bd_upazilas.id = u.upazilla_id', 'left');
		$this->db->join('bd_districts', 'bd_districts.id = bd_upazilas.district_id', 'left');
		$this->db->join('bd_divisions', 'bd_divisions.id = bd_districts.division_id', 'left');
		$this->db->where('u.id', $id);
		return $this->db->get('bd_unions as u')->row();
	}
 

}