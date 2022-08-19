<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Expense_model extends Fm_model {

    public $table = 'expenses';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get total rows
    function total_rows($q = NULL)
    {

        if ($q) {
            $this->db->like('id', $q);
            $this->db->or_like('trans_date', $q);
            $this->db->or_like('head_id', $q);
            $this->db->or_like('sub_head_id', $q);
            $this->db->or_like('remark', $q);
            $this->db->or_like('amount', $q);
            $this->db->or_like('timestamp', $q);
            $this->db->or_like('user_id', $q);
            $this->db->or_like('status', $q);
        }
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->select('expenses.*,h.name as head_name, sh.name as sub_head');
        $this->db->join('ledger_heads as h','h.id=expenses.head_id','LEFT');
        $this->db->join('ledger_heads as sh','sh.id=expenses.sub_head_id','LEFT');
        $this->db->order_by($this->id, $this->order);
        $this->db->where('expenses.status', 'OK');
        if ($q) {
            $this->db->like('remark', $q);            
        }
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

}
