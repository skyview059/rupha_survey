<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Trans_model extends Fm_model {

    public $table = 'member_stmt';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get total rows
    function total_rows($status,$dps=false)
    {      
        $this->db->from('member_stmt as ms');
        $this->sql_builder($status,$dps);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start, $status,$dps=false)
    {
        $this->db->order_by($this->id, $this->order);

        $this->db->select('ms.*,s.name,s.address');
        $this->db->select('h.name as head_name, sh.name as sub_head');
        $this->db->select('DATE_FORMAT(ms.trans_date, "%d-%b-%Y") AS trans_date');
        $this->db->select('DATE_FORMAT(ms.month_of_dps, "%M, %Y") AS dps_month');
        
        $this->db->from('member_stmt as ms');
        $this->db->join('members as s', 's.id=ms.member_id', 'LEFT');
        
        $this->db->join('ledger_heads as h','h.id=ms.head_id','LEFT');
        $this->db->join('ledger_heads as sh','sh.id=ms.sub_head_id','LEFT');

        $this->sql_builder($status,$dps);
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }

    private function sql_builder($status = 'OK',$dps=false)
    {
//        if($user_id){ $this->db->where('collected_by', $user_id); }           
//        if($dps){ 
//            $this->db->where('member_id >', '0');
//        } else {
//            $this->db->where('member_id', '0');
//        }
        if ($status) {
            $this->db->where('ms.status', $status);
        }
    }

}
