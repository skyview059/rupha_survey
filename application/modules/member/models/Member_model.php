<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Member_model extends Fm_model {

    public $table   = 'members';
    public $id      = 'id';
    public $order   = 'ASC';

    function __construct() {
        parent::__construct();
    }

    function total_rows($q = NULL, $balance = 'Any') {
        $this->sql_balance_query($balance);  
        $this->sql_search_query($q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    function get_limit_data($limit, $start = 0, $q = NULL, $balance='Any') {                
        
        $this->db->select_sum('dr');        
	$this->db->where('member_id', "{$this->table}.id", false);        
	$_sql_dr = $this->db->get_compiled_select('member_stmt');  
        
        $this->db->select_sum('cr');        
	$this->db->where('member_id', "{$this->table}.id", false);        
	$_sql_cr = $this->db->get_compiled_select('member_stmt');  

	$this->db->select("({$_sql_dr}) as dr_tk");
	$this->db->select("({$_sql_cr}) as cr_tk");
	$this->db->select("{$this->table}.*");      

        
        $this->db->from($this->table);                                      
        $this->sql_balance_query($balance);                
        $this->sql_search_query($q);                
        $this->db->order_by($this->id, $this->order);
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }
        
    private function sql_search_query($q=null){       
        if ($q) {
            $this->db->group_start();            
            $this->db->like('name', $q);
            $this->db->or_like('name', $q);
            $this->db->or_like('contact', $q);            
            $this->db->group_end();                        
        }        
    }
    private function sql_balance_query($balance = 'Any'){
//        if($balance != 'Any'){
//            $this->db->select('sum(b.total_bill-b.discount-b.paid) as balance');
//            $this->db->join('member_stmt as b', 'b.member_id=s.id');
//            $this->db->group_by('b.member_id');
//            if($balance == 'PaymentDue'){  $this->db->having('balance >= 1'); } 
//            if($balance == 'Clear'){  $this->db->having('balance = 0'); }
//            if($balance == 'Advance'){  $this->db->having('balance <= -1'); }      
//        }
    }

}
