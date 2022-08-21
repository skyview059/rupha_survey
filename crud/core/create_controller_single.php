<?php 
$c_lower = strtolower($c);
$string = "<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
/* Author: Khairul Azam
 * Date : ". date('d M Y @h:i a') ."
 */

class {$c} extends Admin_controller{
    function __construct(){
        parent::__construct();
        \$this->load->model('{$m}');
        \$this->load->helper('{$h}');
        \$this->load->library('form_validation');
    }";

  
$string .= "\n\n    public function index(){
        \$q = urldecode(\$this->input->get('q', TRUE));
        \$start = intval(\$this->input->get('start'));
        
        
        \$config['base_url'] = build_pagination_url( Backend_URL . '{$tab_link}/', 'start');
        \$config['first_url'] = build_pagination_url( Backend_URL . '{$tab_link}/', 'start');
        

        \$config['per_page'] = 25;
        \$config['page_query_string'] = TRUE;
        \$config['total_rows'] = \$this->{$m}->total_rows(\$q);
        \${$c_url}s = \$this->{$m}->get_limit_data(\$config['per_page'], \$start, \$q);

        \$this->load->library('pagination');
        \$this->pagination->initialize(\$config);

        \$data = array(
            '{$c_url}s' => \${$c_url}s,
            'q' => \$q,
            'pagination' => \$this->pagination->create_links(),
            'total_rows' => \$config['total_rows'],
            'start' => \$start,
        );
        \$this->viewAdminContent('{$folder}/{$c_url}/{$v_list}', \$data);
    }";


    
$string .= "\n\npublic function create(){
        \$data = array(
            'button' => 'Create',
            'action' => site_url( Backend_URL . '{$tab_link}/create_action'),";
foreach ($all as $row) {
    $string .= "\n\t    '" . $row['column_name'] . "' => set_value('" . $row['column_name'] . "'),";
}
$string .= "\n\t);
        \$this->viewAdminContent('{$folder}/{$c_url}/{$v_create}', \$data);
    }    


    public function create_action(){
        \$this->_rules();

        if (\$this->form_validation->run() == FALSE) {
            \$this->create();
        } else {
            \$data = array(";
foreach ($non_pk as $row) {
    $string .= "\n\t\t'" . $row['column_name'] . "' => \$this->input->post('" . $row['column_name'] . "',TRUE),";    
}
$string .= "\n\t    );

            \$this->{$m}->insert(\$data);
            \$this->session->set_flashdata('message', '<p class=\"ajax_success\">{$c} Added Successfully</p>');
            redirect(site_url( Backend_URL. '{$redirect_link}'));
        }
    }
    
    public function update(\$id){
        \$row = \$this->{$m}->get_by_id(\$id);

        if (\$row) {
            \$data = array(
                'button' => 'Update',
                'action' => site_url( Backend_URL . '$tab_link/update_action'),";
foreach ($all as $row) {
    $string .= "\n\t\t'" . $row['column_name'] . "' => set_value('" . $row['column_name'] . "', \$row->". $row['column_name']."),";
}
$string .= "\n\t    );
            \$this->viewAdminContent('{$folder}/{$c_url}/{$v_update}', \$data);
        } else {
            \$this->session->set_flashdata('message', '<p class=\"ajax_error\">{$c} Not Found</p>');
            redirect(site_url( Backend_URL. '{$redirect_link}'));
        }
    }
    
    public function update_action(){
        \$this->_rules();

        \$id = \$this->input->post('{$pk}', TRUE);
        if (\$this->form_validation->run() == FALSE) {
            \$this->update( \$id );
        } else {
            \$data = array(";
foreach ($non_pk as $row) {
    $string .= "\n\t\t'" . $row['column_name'] . "' => \$this->input->post('" . $row['column_name'] . "',TRUE),";
}    
$string .= "\n\t    );

            \$this->".$m."->update(\$id, \$data);
            \$this->session->set_flashdata('message', '<p class=\"ajax_success\">{$c} Updated Successlly</p>');
            redirect(site_url( Backend_URL. '{$redirect_link}/'));
        }
    }";
    
$string .= "public function delete(\$id){
        \$row = \$this->{$m}->get_by_id(\$id);

        if (\$row) {
            \$this->{$m}->delete(\$id);
            \$this->session->set_flashdata('message', '<p class=\"ajax_success\">{$c} Deleted Successfully</p>');
            redirect(site_url( Backend_URL. '{$redirect_link}'));
        } else {
            \$this->session->set_flashdata('message', '<p class=\"ajax_error\">{$c} Not Found</p>');
            redirect(site_url( Backend_URL. '{$redirect_link}'));
        }
    }

    public function _rules(){";
foreach ($non_pk as $row) {
    $int = $row['data_type'] == 'int' || $row['data_type'] == 'double' || $row['data_type'] == 'decimal' ? '|is_natural_no_zero' : '';
    $string .= "\n\t\$this->form_validation->set_rules('".$row['column_name']."', '".  strtolower(label($row['column_name']))."', 'trim|required{$int}');";
}    
$string .= "\n\n\t\$this->form_validation->set_rules('{$pk}', '{$pk}', 'trim');";
$string .= "\n\t\$this->form_validation->set_error_delimiters('<span class=\"text-danger\">', '</span>');
    }
    
";

$string .= "\n\n}";

$hasil_controller = createFile($string, $target . "controllers/{$c_file}" );

