<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Member_model extends Fm_model {

    public $table = 'members';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get total rows
    function total_rows($q = NULL, $division_id = null, $district_id = null, $upazilla_id = null, $union_id = null, $user_id = null)
    {
       
        $this->db->from($this->table);
        $this->db->join('bd_unions as un', 'un.id = members.union_id', 'left');
        $this->db->join('bd_upazilas as up', 'up.id = un.upazilla_id', 'left');
        $this->db->join('bd_districts as dis', 'dis.id = up.district_id', 'left');
        $this->db->join('bd_divisions as div', 'div.id = dis.division_id', 'left');
        $this->db->join('users', 'users.id = members.created_by', 'left');        
        $this->search_sql($division_id, $district_id, $upazilla_id, $union_id, $user_id,$q );
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL, $division_id = null, $district_id = null, $upazilla_id = null, $union_id = null, $user_id = null)
    {

        $this->db->select('members.*, un.bn_name as union_name, up.bn_name as upazila_name');
        $this->db->select('dis.bn_name as district_name, div.bn_name as division_name');
        $this->db->select('ssb.name_ba as ssb_name, is.name_ba as income_source_name');
        $this->db->select('users.full_name');
        $this->db->join('bd_unions as un', 'un.id = members.union_id', 'left');
        $this->db->join('bd_upazilas as up', 'up.id = un.upazilla_id', 'left');
        $this->db->join('bd_districts as dis', 'dis.id = up.district_id', 'left');
        $this->db->join('bd_divisions as div', 'div.id = dis.division_id', 'left');
        $this->db->join('social_security_benefits as ssb', 'ssb.id = members.social_security_benefit_id', 'left');
        $this->db->join('income_sources as is', 'is.id = members.income_source_id', 'left');
        $this->db->join('asset_types as at', 'at.id = members.asset_type_id', 'left');
        $this->db->join('users', 'users.id = members.created_by', 'left');
        $this->db->order_by($this->id, $this->order);

        $this->search_sql($division_id, $district_id, $upazilla_id, $union_id, $user_id,$q );
        
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
    
    function search_sql($division_id, $district_id, $upazilla_id, $union_id, $user_id,$q){
        
        if (in_array($this->role_id, [3, 4])) {            
            $this->db->where('members.union_id', $this->union_id);
            $this->db->where('members.created_by', $this->user_id);
        } else {
            if (!empty($user_id)) {
                $this->db->where('members.created_by', $user_id);
            }
        }

        if (!empty($division_id)) {
            $this->db->where('div.id', $division_id);
        }

        if (!empty($district_id)) {
            $this->db->where('dis.id', $district_id);
        }

        if (!empty($upazilla_id)) {
            $this->db->where('up.id', $upazilla_id);
        }

        if (!empty($union_id)) {
            $this->db->where('un.id', $union_id);
        }

        if ($q) {
            $this->db->group_start();
            $this->db->like('members.id', $q);
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
            $this->db->group_end();
        }

    }

    function get_by_id($id)
    {
        $this->db->select('m.*, un.bn_name as union_name, up.bn_name as upazila_name');
        $this->db->select('ssb.name_ba as ssb_name, is.name_ba as income_source_name');
        $this->db->select('dis.bn_name as district_name, div.bn_name as division_name');
        $this->db->select('at.name_ba as asset_type_name');
        
        $this->db->from("{$this->table} as m");
        $this->db->join('bd_unions as un', 'un.id = m.union_id', 'left');
        $this->db->join('bd_upazilas as up', 'up.id = un.upazilla_id', 'left');
        $this->db->join('bd_districts as dis', 'dis.id = up.district_id', 'left');
        $this->db->join('bd_divisions as div', 'div.id = dis.division_id', 'left');
        $this->db->join('social_security_benefits as ssb', 'ssb.id = m.social_security_benefit_id', 'left');
        $this->db->join('income_sources as is', 'is.id = m.income_source_id', 'left');
        $this->db->join('asset_types as at', 'at.id = m.asset_type_id', 'left');
        $this->db->where('m.id', $id);
        if (in_array($this->role_id, [3, 4])) {            
            $this->db->where('m.union_id', $this->union_id);
        }

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
        if ($this->db->delete('member_relatives')) {
            return true;
        } else {
            return false;
        }
    }

    public function get_latest_members($limit)
    {

        $this->db->select('m.*, un.bn_name as union_name, up.bn_name as upazila_name');
//        $this->db->select('bddi.bn_name as district_name, bddi.bn_name as division_name');
//        $this->db->select('ssb.name_ba as ssb_name, is.name_ba as income_source_name');
        $this->db->select('u.full_name');
        $this->db->join('bd_unions as un', 'un.id = m.union_id', 'LEFT');
        $this->db->join('bd_upazilas as up', 'up.id = un.upazilla_id', 'LEFT');
//        $this->db->join('bd_districts as di', 'bddi.id = bdup.district_id', 'LEFT');
//        $this->db->join('bd_divisions as dv', 'bddv.id = bddi.division_id', 'LEFT');
//        $this->db->join('social_security_benefits as ssb', 'ssb.id = m.social_security_benefit_id', 'LEFT');
//        $this->db->join('income_sources as is', 'is.id = m.income_source_id', 'LEFT');
//        $this->db->join('asset_types as at', 'at.id = m.asset_type_id', 'LEFT');
        $this->db->join('users as u', 'u.id = m.created_by', 'LEFT');
        $this->db->order_by('m.id', 'DESC');

//        if (in_array($this->role_id, [3, 4])) {            
//            $this->db->where('m.union_id', $this->union_id);
//        }
        $this->db->limit($limit);
        return $this->db->get('members as m')->result();        
    }

    public function getUnionInfoById($id)
    {
        if(empty($id)){
            return (object) [ 
                'id' => 0, 'union_name' => '', 'union_bn_name' => '',
                'upazila_name' => '', 'upazila_bn_name' => '',
                'division_name' => '', 'division_bn_name' => ''
            ];
        }
        
        $this->db->select('u.id, u.name as union_name, u.bn_name as union_bn_name');
        $this->db->select('up.name as upazila_name, up.bn_name as upazila_bn_name');
        $this->db->select('dis.name as district_name, dis.bn_name as district_bn_name');
        $this->db->select('div.name as division_name, div.bn_name as division_bn_name');
        
        $this->db->join('bd_upazilas as up', 'up.id = u.upazilla_id', 'left');
        $this->db->join('bd_districts as dis', 'dis.id = up.district_id', 'left');
        $this->db->join('bd_divisions as div', 'div.id = dis.division_id', 'left');
        $this->db->where('u.id', $id);
        return $this->db->get('bd_unions as u')->row();
    }

}
