<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ajax
 *
 * @author LENOVO
 */
class Ajax extends Admin_controller{
    function __construct(){
        parent::__construct();                
        $this->load->library('sms/Adnsms');
    }    
    
    
    public function save_income_bak(){
        ajaxAuthorized();
        $tran_type      = $this->input->post('tran_type');
        $dr = ($tran_type=='dr') ? $this->input->post('amount') : 0;
        $cr = ($tran_type=='cr') ? $this->input->post('amount') : 0;
        $dps = $this->input->post('dps');
        $data = array(
            'user_id'             => $this->user_id,
            'member_id'       => (int) $this->input->post('member_id'),
            'trans_date'        => $this->input->post('trans_date'),
            'head_id'        => (int) $this->input->post('head_id'),
            'sub_head_id'        => (int) $this->input->post('sub_head_id'),
            'month_of_dps'  => "{$dps['year']}-{$dps['mm']}-01",
            'dr'                    => (int) $dr,
            'cr'                     => (int) $cr,
            'remark'             => $this->input->post('remark'),
            'status'               => 'OK',
            'timestamp'         => date('Y-m-d H:i:s')
        );
        $this->db->insert('member_stmt',$data);
        
        $this->session->set_flashdata('message', "<p class='ajax_success'>DPS Collected Successfully.</p>"); 
        echo ajaxRespond('OK', "<p class='ajax_success'>DPS  Collected Successfully</p>");        
    }
    
    
    public function save_income(){
        ajaxAuthorized();
        $tran_type      = $this->input->post('tran_type');
        $dr = ($tran_type=='dr') ? $this->input->post('amount') : 0;
        $cr = ($tran_type=='cr') ? $this->input->post('amount') : 0;        
        $data = array(
            'user_id'       => $this->user_id,
            'member_id'     => (int) $this->input->post('member_id'),
            'trans_date'    => $this->input->post('trans_date'),                                  
            'dr'            => (int) $dr,
            'cr'            => (int) $cr,
            'remark'        => $this->input->post('remark'),
            'status'        => 'OK',
            'timestamp'     => date('Y-m-d H:i:s')
        );
        $this->db->insert('member_stmt',$data);
        
        $this->session->set_flashdata('message', "<p class='ajax_success'>DPS Collected Successfully.</p>"); 
        echo ajaxRespond('OK', "<p class='ajax_success'>DPS  Collected Successfully</p>");        
    }
    
    public function save_subscription_bak(){
        ajaxAuthorized();
        $tran_type      = $this->input->post('tran_type');
        $dr = ($tran_type=='dr') ? $this->input->post('amount') : 0;
        $cr = ($tran_type=='cr') ? $this->input->post('amount') : 0;
        $dps = $this->input->post('dps');
        $data = array(
            'user_id'             => $this->user_id,
            'member_id'       => (int) $this->input->post('member_id'),
            'trans_date'        => $this->input->post('trans_date'),
            'head_id'        => (int) $this->input->post('head_id'),
            'sub_head_id'        => (int) $this->input->post('sub_head_id'),
            'month_of_dps'  => "{$dps['year']}-{$dps['mm']}-01",
            'dr'                    => (int) $dr,
            'cr'                     => (int) $cr,
            'remark'             => $this->input->post('remark'),
            'status'               => 'OK',
            'timestamp'         => date('Y-m-d H:i:s')
        );
        $this->db->insert('member_stmt',$data);
        
        $this->session->set_flashdata('message', "<p class='ajax_success'>DPS Collected Successfully.</p>"); 
        echo ajaxRespond('OK', "<p class='ajax_success'>DPS  Collected Successfully</p>");        
    }
        
    
     public function save_expense(){
        ajaxAuthorized();
        $data = array(
            'trans_date'    => $this->input->post('trans_date',TRUE),
            'head_id'       => $this->input->post('head_id',TRUE),
            'sub_head_id'   => $this->input->post('sub_head_id',TRUE),
            'remark'        => $this->input->post('remark',TRUE),
            'amount'        => $this->input->post('amount',TRUE),
            'timestamp'     => date('Y-m-d H:i:s'),
            'user_id'       => getLoginUserData('user_id'),
            'status'        => 'OK',
        );

        $this->db->insert('expenses', $data);
        echo ajaxRespond('OK', '<p class="ajax_success">Expense Added Successfully</p>');
    }        
    
    
    
    public function void($id){                
        $this->db->set('status','Void');
        $this->db->where('id', $id );
        $this->db->update('expenses');  
        redirect('trans/expense');
    }
    
    
    public function save_banking() {
        ajaxAuthorized();
        $bank_id    = (int)$this->input->post('bank_id');                
        $tran_type  = $this->input->post('tran_type');
        $amount     = (int) $this->input->post('amount');        

        $opeing_balance     = $this->getBalance('banks', 'balance', $bank_id);
        $bank['bank_id']    = $bank_id;
        $bank['user_id']    = $this->user_id;
        $bank['trans_date'] = $this->input->post('trans_date');

        $bank['remark']     = $this->input->post('remark');                
        $bank['opening_balance'] = $opeing_balance;
        if ($tran_type == 'cr') {
            $bank['deposit']    = $amount;
            $bank['withdraw']   = 0;
            $closing_balance    = $opeing_balance + $amount;
        } else {
            $bank['deposit']    = 0;
            $bank['withdraw']   = $amount;
            $closing_balance    = $opeing_balance - $amount;
        }
        $bank['closing_balance']    = $closing_balance;
        $bank['timestamp']          = date('Y-m-d H:i:s');
        $bank['status']             = 'OK';

        $this->db->trans_start();
        $this->db->insert('bank_statement', $bank);
        $this->setBalance('banks', 'balance', $bank_id, $closing_balance);
        $this->db->trans_complete();

        echo ajaxRespond('OK', '<p class="ajax_success">Bank Entry Saved Successfully.</p>');                                                    
    }    
    
    private function getBalance($table, $column, $where_id) {        
        $result = $this->db->select($column)->where('id', $where_id)->get($table)->row();
        if ($result) {
            return $result->$column;
        } else {
            return 0;
        }
    }

    private function setBalance($table, $column, $where_id, $setBalance = 0) {        
        $this->db->set($column, $setBalance)
                ->set('modified', date('Y-m-d H:i:s'))
                ->where('id', $where_id)
                ->update($table);
    }
}
