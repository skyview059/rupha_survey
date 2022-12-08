<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_controller {    
    
    function __construct() {
        parent::__construct();
        $this->load->model('member/Member_model');
        $this->load->helper('dashboard');                
    }
    
    public function index(){
        $members = $this->Member_model->get_latest_members(10);        
        $data['start'] = 0;
        $data['members'] = $members;
        
        if(in_array($this->role_id, [1,2])){
            self::showReport2Admin( $data );
        }else{
            self::showReport2Secretary( $data );            
        }
    }
    
    
    private function showReport2Secretary( $data ){
        $today = date( 'Y-m-d');
        $union_id = getLoginUserData('union_id');
        $union_info = $this->Member_model->getUnionInfoById($union_id);

        $data['union_info'] = $union_info;
        //Get Member Statistics Data
        $todayCount = $this->db->from("members")->where('created_by',$this->user_id)->where('DATE(created_at)', $today)->count_all_results();
        $last7DayCount = $this->db->from("members")->where('created_by',$this->user_id)->where('DATE(created_at)>=', $last7Days)->where('DATE(created_at)<=', $today)->count_all_results();
        $currentMonthCount = $this->db->from("members")->where('created_by', $this->user_id)->where('MONTH(created_at)', date("m"))->count_all_results();
        $currentYearCount = $this->db->from("members")->where('created_by', $this->user_id)->where('YEAR(created_at)', date("Y"))->count_all_results();
        $lifetimeCount = $this->db->from("members")->where('created_by', $this->user_id)->count_all_results();

        $data['today_count'] = $todayCount;
        $data['last_7_day_count'] = $last7DayCount;
        $data['current_month_count'] = $currentMonthCount;
        $data['current_year_count'] = $currentYearCount;
        $data['lifetime_count'] = $lifetimeCount;

        $this->viewAdminContent('secretary', $data);
    }
    
    private function showReport2Admin( $data ){
        $today = date( 'Y-m-d');
        $last7Days = date('Y-m-d', strtotime("-7 day"));
        $statistics = [];
        $secretaries = $this->db->where_in('role_id',[3,4])->where('status', 'Active')->get('users')->result();
        if($secretaries){
            foreach ($secretaries as $key => $user) {

                //Get union information by ID
                $union_info = $this->Member_model->getUnionInfoById($user->union_id);

                //Get Member Statistics Data
                $todayCount = $this->db->from("members")->where('created_by', $user->id)->where('DATE(created_at)', $today)->count_all_results();
                $last7DayCount = $this->db->from("members")->where('created_by', $user->id)->where('DATE(created_at)>=', $last7Days)->where('DATE(created_at)<=', $today)->count_all_results();
                $currentMonthCount = $this->db->from("members")->where('created_by', $user->id)->where('MONTH(created_at)', date("m"))->count_all_results();
                $currentYearCount = $this->db->from("members")->where('created_by', $user->id)->where('YEAR(created_at)', date("Y"))->count_all_results();
                $lifetimeCount = $this->db->from("members")->where('created_by', $user->id)->count_all_results();

                $statistics[$user->id]['full_name'] = $user->full_name;
                $statistics[$user->id]['union_info'] = $union_info;
                $statistics[$user->id]['today_count'] = $todayCount;
                $statistics[$user->id]['last_7_day_count'] = $last7DayCount;
                $statistics[$user->id]['current_month_count'] = $currentMonthCount;
                $statistics[$user->id]['current_year_count'] = $currentYearCount;
                $statistics[$user->id]['lifetime_count'] = $lifetimeCount;
            }
        }

        $data['statistics'] = $statistics;
        $this->viewAdminContent('dashboard', $data);
    }
}