<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sms_model extends Fm_model {

    public $table = 'sms_log';
    public $id = 'id';
    public $order = 'DESC';

    function __construct() {
        parent::__construct();
    }

    // get total rows
    function total_sent() {  
        // SELECT sum(qty) as total FROM `sms_log`
        $this->db->select_sum('qty');
        $sms = $this->db->get('sms_log')->row();
        return $sms->qty;
    }
    
    function total_rows($q = NULL) {
        if ($q) {
            $this->db->like('phone', $q);
            $this->db->or_like('body', $q);
        }
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->select("{$this->table}.*,s.name as member");
        $this->db->from($this->table);
        $this->db->join('members as s',"s.id={$this->table}.member_id",'LEFT');
        
        $this->db->order_by($this->id, $this->order);
        if ($q) {
            $this->db->like('phone', $q);
            $this->db->or_like('body', $q);
        }
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }

}
