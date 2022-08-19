<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
/* Author: Khairul Azam
 * Date : 2022-01-12
 */

class Trans extends Admin_controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Trans_model');
        $this->load->model('Expense_model');        
        $this->load->helper('trans');
        $this->load->library('form_validation');
    }

    public function index_bak(){
        $status     = ($this->input->get('status')) ? $this->input->get('status') : "OK";                
        $start      = (int) $this->input->get('start');
        $limit      = ($this->input->get('limit')) ? $this->input->get('limit') : 200;                
        
        $config['base_url']  = build_pagination_url( Backend_URL . 'trans/', 'start');
        $config['first_url'] = build_pagination_url( Backend_URL . 'trans/', 'start');
        

        $config['per_page'] = $limit;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Trans_model->total_rows($status );
        $incomes = $this->Trans_model->get_limit_data($config['per_page'], $start, $status);
        
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'incomes' => $incomes,            
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start'     => $start,
            'limit'    => $limit 
        );
        $this->viewAdminContent('trans/trans/index', $data);
    }

    public function index(){
        $status     = ($this->input->get('status')) ? $this->input->get('status') : "OK";                
        $start      = (int) $this->input->get('start');
        $limit      = ($this->input->get('limit')) ? $this->input->get('limit') : 200;                
        
        $config['base_url']  = build_pagination_url( Backend_URL . 'trans', 'start');
        $config['first_url'] = build_pagination_url( Backend_URL . 'trans', 'start');
        
        $config['per_page'] = $limit;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Trans_model->total_rows($status, $dps = true );
        $dpss = $this->Trans_model->get_limit_data($config['per_page'], $start, $status, $dps = true);
        
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'dpss' => $dpss,            
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start'     => $start,
            'limit'    => $limit 
        );
        $this->viewAdminContent('trans/trans/subscription', $data);
    }

    public function expense(){
        $q = urldecode($this->input->get('q', TRUE));
        $collectBy = urldecode($this->input->get('collectBy', TRUE));
        $area_id = urldecode($this->input->get('area', TRUE));
        $month = urldecode($this->input->get('month', TRUE));
        $year = urldecode($this->input->get('year', TRUE));
        
        $start = intval($this->input->get('start'));
        
        $config['base_url'] = build_pagination_url( Backend_URL . 'expense/', 'start');
        $config['first_url'] = build_pagination_url( Backend_URL . 'expense/', 'start');

        $config['per_page'] = 25;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Expense_model->total_rows($q,$collectBy,$area_id,$month,$year);
        $expenses = $this->Expense_model->get_limit_data($config['per_page'], $start, $q,$collectBy,$area_id,$month,$year);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'expenses' => $expenses,
            'collectBy' => $collectBy,
            'month' => $month,
            'year' => $year,
            'min_year' => date('Y', strtotime('-2 Year')),
            'max_year' => date('Y', strtotime('+1 Year')),
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        
        $this->viewAdminContent('trans/trans/expense', $data);
    }
    
    
    
    public function bank() {
        $date_from  = $this->input->get('date_from');
        $date_to    = $this->input->get('date_to');
        
        if(empty($date_from)){
            $date_from = date('Y-m-d', strtotime('-30 days'));            
        }        
        if(empty($date_to)){            
            $date_to = date('Y-m-d', strtotime('+1 day'));
        }        
        
        
        $branch_id  = (int) $this->input->get('branch_id');
        $bank_id    = (int) $this->input->get('bank_id');
                         
        $this->db->select('bs.id,bs.trans_date,bs.remark,bs.deposit,bs.withdraw,bs.bank_id');
        $this->db->select('b.account_name,b.account_no,b.bank_name');
        $this->db->from('bank_statement as bs');
        $this->db->join('banks as b','b.id=bs.bank_id','LEFT');
        if($date_from)  { $this->db->where('trans_date >=', $date_from ); }
        if($date_to)    { $this->db->where('trans_date <=', $date_to ); }        
        if($branch_id)  { $this->db->where('branch_id', $branch_id ); }        
        if($bank_id)    { $this->db->where('bank_id', $bank_id ); }        
        $this->db->where('bs.status', 'OK' ); 
                        
        $data['trans']      = $this->db->get()->result();        
        $data['date_from']  = $date_from;
        $data['date_to']    = $date_to;
        $data['branch_id']  = $branch_id;
        $data['bank_id']    = $bank_id;
                
        $this->viewAdminContent('trans/trans/bank', $data);
    }


    /* Income Entry */
    public function income_entry(){

        $data = array(                
            'action'    => site_url( Backend_URL . 'trans/ajax/save_income'),
            'trans_date' => set_value('trans_date', date('Y-m-d')),
            'tran_type' => set_value('tran_type'),
            'month_of_dps' => set_value('month_of_dps'),
            'remark'    => set_value('remark'),
            'amount'    => set_value('amount'),
            'status'    => set_value('status', 'Paid'),
            'role_id'   => getLoginUserData('role_id'),
            'user_id'   => getLoginUserData('user_id'),
            'dps_y'   => date('Y'),
            'dps_m'   => date('m'),
        );        
        $this->viewAdminContent('trans/entry/income', $data);         
    }
     
    
     /* Subscripton Entry */
    public function subscripton(){

        $data = array(                
            'action'    => site_url( Backend_URL . 'trans/ajax/save_subscripton'),
            'trans_date' => set_value('trans_date', date('Y-m-d')),
            'tran_type' => set_value('tran_type'),
            'month_of_dps' => set_value('month_of_dps'),
            'remark'    => set_value('remark'),
            'amount'    => set_value('amount'),
            'status'    => set_value('status', 'Paid'),
            'role_id'   => getLoginUserData('role_id'),
            'user_id'   => getLoginUserData('user_id'),
            'dps_y'   => date('Y'),
            'dps_m'   => date('m'),
        );        
        $this->viewAdminContent('trans/entry/subscription', $data);         
    }
     
    
    /* Expense Entry */
    public function expense_entry(){
        $data = array(
            'button' => 'Create',
            'action' => site_url( Backend_URL . 'trans/ajax/save_expense'),
	    'id' => set_value('id'),
	    'trans_date' => set_value('trans_date', date('Y-m-d')),
	    'head_id' => set_value('head_id'),
	    'sub_head_id' => set_value('sub_head_id'),
	    'remark' => set_value('remark'),
	    'amount' => set_value('amount')
	);
        $this->viewAdminContent('trans/entry/expense', $data);
    }
    
    /* Expense Entry */
    public function banking_entry(){
        $data = array(
            'button' => 'Create',
            'action' => site_url( Backend_URL . 'trans/ajax/save_expense'),
	    'id' => set_value('id'),
	    'trans_date' => set_value('trans_date'),
	    'head_id' => set_value('head_id'),
	    'sub_head_id' => set_value('sub_head_id'),
	    'remark' => set_value('remark'),
	    'amount' => set_value('amount'),
	    'user_id' => set_value('user_id', $this->user_id ),
	);
        $this->viewAdminContent('trans/entry/banking', $data);
    }
    
    public function _menu(){
        return add_main_menu('Trans Report', 'trans', 'trans', 'fa-hand-o-right');        
        /*
        return buildMenuForMoudle([
            'module'    => 'Trans',
            'icon'      => 'fa-hand-o-right',
            'href'      => 'trans',                    
            'children'  => [
                [
                    'title' => 'Trans Log',
                    'icon'  => 'fa fa-bars',
                    'href'  => 'trans'
                ],[
                    'title' => 'Expense Log',
                    'icon'  => 'fa fa-plus',
                    'href'  => 'trans/expense'
                ]
            ]        
        ]);
         * 
         */
    }
}