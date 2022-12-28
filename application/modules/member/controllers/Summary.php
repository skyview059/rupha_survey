<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* Author: Khairul Azam
 * Date : 2022-08-21
 */

class Summary extends Admin_controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Member_model');
    }

    public function index()
    {

        
    
        $today = date( 'Y-m-d');
        $last7Days = date('Y-m-d', strtotime("-7 day"));
        $statistics = [];
        $secretaries = $this->db->where_in('role_id',[3,4])->where('status', 'Active')->get('users')->result();
        if($secretaries){
            foreach ($secretaries as $user) {

                //Get union information by ID
                $union_info = $this->Member_model->getUnionInfoById($user->union_id);

                //Get Member Statistics Data
                $todayCount = $this->db->where('created_by', $user->id)->where('DATE(created_at)', $today)->count_all_results('members');
                $last7DayCount = $this->db->where('created_by', $user->id)->where('DATE(created_at)>=', $last7Days)->where('DATE(created_at)<=', $today)->count_all_results('members');
                $currentMonthCount = $this->db->where('created_by', $user->id)->where('MONTH(created_at)', date("m"))->count_all_results('members');
                $currentYearCount = $this->db->where('created_by', $user->id)->where('YEAR(created_at)', date("Y"))->count_all_results('members');
                $lifetimeCount = $this->db->where('created_by', $user->id)->count_all_results('members');

                $statistics[$user->id]['full_name'] = $user->full_name;
                $statistics[$user->id]['union_info'] = $union_info;
                $statistics[$user->id]['today_count'] = $todayCount;
                $statistics[$user->id]['last_7_day_count'] = $last7DayCount;
                $statistics[$user->id]['current_month_count'] = $currentMonthCount;
                $statistics[$user->id]['current_year_count'] = $currentYearCount;
                $statistics[$user->id]['lifetime_count'] = $lifetimeCount;
            }
        }        
        
//        dd( $statistics );
        $this->viewAdminContent('member/member/summary', $statistics );
    }
    
}
