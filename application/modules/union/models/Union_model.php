<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Union_model extends Fm_model {

    public $table   = 'bd_unions';
    public $id      = 'id';
    public $order   = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    /* get total rows */ 
    function get_by_id($id=0)
    {        
        $this->db->select('unio.*,district_id,division_id');        
        $this->db->from('bd_unions as unio');        
        $this->db->join('bd_upazilas as upaz','unio.upazilla_id=upaz.id','LEFT');
        $this->db->join('bd_districts as dist','upaz.district_id=dist.id','LEFT');        
        $this->db->where('unio.id', $id );
        return $this->db->get()->row();
    }
    
    /* get total rows */ 
    function total_rows($upazilla_id=0,$q = NULL)
    {        
        $this->db->from('bd_unions as un');
        $this->__filter($upazilla_id,$q);
        return $this->db->count_all_results();
    }

    /* get data with limit and search */ 
    function get_limit_data($limit, $start = 0,$upazilla_id=0,$q = NULL)
    {
        $this->db->select('un.*,up.bn_name as upazilla');
        $this->db->from('bd_unions as un');
        $this->db->join('bd_upazilas as up', 'up.id=un.upazilla_id', 'LEFT');
        $this->__filter($upazilla_id,$q);
        $this->db->order_by($this->id, $this->order);        
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }
    
    function __filter($upazilla_id,$q){
        if($upazilla_id>1){ $this->db->where('upazilla_id', $upazilla_id ); }
        if ($q) {           
            $this->db->like('un.name', $q);
            $this->db->or_like('un.bn_name', $q);
        }
    }
    

}
