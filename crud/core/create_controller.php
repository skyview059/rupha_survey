<?php 
$string = "<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
/* Author: Khairul Azam
 * Date : ". date('Y-m-d') ."
 */

class " . $c . " extends Admin_controller{
    function __construct(){
        parent::__construct();
        \$this->load->model('$m');
        \$this->load->helper('$h');
        \$this->load->library('form_validation');
    }";

if ($jenis_tabel != 'datatables') {
    
$string .= "\n\n    public function index(){
        \$q = urldecode(\$this->input->get('q', TRUE));
        \$start = intval(\$this->input->get('start'));
        
        if (\$q <> '') {
            \$config['base_url'] = Backend_URL . '$tab_link/?q=' . urlencode(\$q);
            \$config['first_url'] = Backend_URL . '$tab_link/?q=' . urlencode(\$q);
        } else {
            \$config['base_url'] = Backend_URL . '$tab_link/';
            \$config['first_url'] = Backend_URL . '$tab_link/';
        }

        \$config['per_page'] = 25;
        \$config['page_query_string'] = TRUE;
        \$config['total_rows'] = \$this->" . $m . "->total_rows(\$q);
        \$$c_url = \$this->" . $m . "->get_limit_data(\$config['per_page'], \$start, \$q);

        \$this->load->library('pagination');
        \$this->pagination->initialize(\$config);

        \$data = array(
            '" . $c_url . "' => \$$c_url,
            'q' => \$q,
            'pagination' => \$this->pagination->create_links(),
            'total_rows' => \$config['total_rows'],
            'start' => \$start,
        );
        \$this->viewAdminContent('$folder/$c_url/$v_list', \$data);
    }";

} else {
    
$string .="\n\n    public function index(){
        \$$c_url = \$this->" . $m . "->get_all();

        \$data = array(
            '" . $c_url . "_data' => \$$c_url
        );

        \$this->viewAdminContent('$folder/$c_url/$v_list', \$data);
    }";

}
    
$string .= "\n\n    public function read(\$id){
        \$row = \$this->" . $m . "->get_by_id(\$id);
        if (\$row) {
            \$data = array(";
foreach ($all as $row) {
    $string .= "\n\t\t'" . $row['column_name'] . "' => \$row->" . $row['column_name'] . ",";
}
$string .= "\n\t    );
            \$this->viewAdminContent('$folder/$c_url/$v_read', \$data);
        } else {
            \$this->session->set_flashdata('message', '<p class=\"ajax_error\">Record Not Found</p>');
            redirect(site_url( Backend_URL. '$redirect_link'));
        }
    }

    public function create(){
        \$data = array(
            'button' => 'Create',
            'action' => site_url( Backend_URL . '$tab_link/create_action'),";
foreach ($all as $row) {
    $string .= "\n\t    '" . $row['column_name'] . "' => set_value('" . $row['column_name'] . "'),";
}
$string .= "\n\t);
        \$this->viewAdminContent('$folder/$c_url/$v_create', \$data);
    }
    
    public function create_action(){
        \$this->_rules();

        if (\$this->form_validation->run() == FALSE) {
            \$this->create();
        } else {
            \$data = array(";
foreach ($non_pk as $row) {
    $string .= "\n\t\t'" . $row['column_name'] . "' => \$this->input->post('" . $row['column_name'] . "',TRUE),";
    
    // created
    // modefied 
    // status 
    // user_id 
}
$string .= "\n\t    );

            \$this->".$m."->insert(\$data);
            \$this->session->set_flashdata('message', '<p class=\"ajax_success\">Create Record Success</p>');
            redirect(site_url( Backend_URL. '$redirect_link'));
        }
    }
    
    public function update(\$id){
        \$row = \$this->".$m."->get_by_id(\$id);

        if (\$row) {
            \$data = array(
                'button' => 'Update',
                'action' => site_url( Backend_URL . '$tab_link/update_action'),";
foreach ($all as $row) {
    $string .= "\n\t\t'" . $row['column_name'] . "' => set_value('" . $row['column_name'] . "', \$row->". $row['column_name']."),";
}
$string .= "\n\t    );
            \$this->viewAdminContent('$folder/$c_url/$v_update', \$data);
        } else {
            \$this->session->set_flashdata('message', '<p class=\"ajax_error\">Record Not Found</p>');
            redirect(site_url( Backend_URL. '$redirect_link'));
        }
    }
    
    public function update_action(){
        \$this->_rules();

        \$id = \$this->input->post('$pk', TRUE);
        if (\$this->form_validation->run() == FALSE) {
            \$this->update( \$id );
        } else {
            \$data = array(";
foreach ($non_pk as $row) {
    $string .= "\n\t\t'" . $row['column_name'] . "' => \$this->input->post('" . $row['column_name'] . "',TRUE),";
}    
$string .= "\n\t    );

            \$this->".$m."->update(\$id, \$data);
            \$this->session->set_flashdata('message', '<p class=\"ajax_success\">Data Updated Successlly</p>');
            redirect(site_url( Backend_URL. '$redirect_link/update/'. \$id ));
        }
    }";
    
$string .= "\n\n    public function delete(\$id){
        \$row = \$this->" . $m . "->get_by_id(\$id);
        if (\$row) {
            \$data = array(";
foreach ($all as $row) {
    $string .= "\n\t\t'" . $row['column_name'] . "' => \$row->" . $row['column_name'] . ",";
}
$string .= "\n\t    );
            \$this->viewAdminContent('$folder/$c_url/$v_delete', \$data);
        } else {
            \$this->session->set_flashdata('message', '<p class=\"ajax_error\">Record Not Found</p>');
            redirect(site_url( Backend_URL. '$redirect_link'));
        }
    }


    public function delete_action(\$id){
        \$row = \$this->".$m."->get_by_id(\$id);

        if (\$row) {
            \$this->".$m."->delete(\$id);
            \$this->session->set_flashdata('message', '<p class=\"ajax_success\">Delete Record Success</p>');
            redirect(site_url( Backend_URL. '$redirect_link'));
        } else {
            \$this->session->set_flashdata('message', '<p class=\"ajax_error\">Record Not Found</p>');
            redirect(site_url( Backend_URL. '$redirect_link'));
        }
    }

    public function _rules(){";
foreach ($non_pk as $row) {
    $int = $row['data_type'] == 'int' || $row['data_type'] == 'double' || $row['data_type'] == 'decimal' ? '|numeric' : '';
    $string .= "\n\t\$this->form_validation->set_rules('".$row['column_name']."', '".  strtolower(label($row['column_name']))."', 'trim|required$int');";
}    
$string .= "\n\n\t\$this->form_validation->set_rules('$pk', '$pk', 'trim');";
$string .= "\n\t\$this->form_validation->set_error_delimiters('<span class=\"text-danger\">', '</span>');
    }
    
";

if ($export_excel == '1') {
    $string .= "\n\n    public function excel(){
        \$this->load->helper('exportexcel');
        \$namaFile = \"$table_name.xls\";
        \$judul = \"$table_name\";
        \$tablehead = 0;
        \$tablebody = 1;
        \$nourut = 1;
        //penulisan header
        header(\"Pragma: public\");
        header(\"Expires: 0\");
        header(\"Cache-Control: must-revalidate, post-check=0,pre-check=0\");
        header(\"Content-Type: application/force-download\");
        header(\"Content-Type: application/octet-stream\");
        header(\"Content-Type: application/download\");
        header(\"Content-Disposition: attachment;filename=\" . \$namaFile . \"\");
        header(\"Content-Transfer-Encoding: binary \");

        xlsBOF();

        \$kolomhead = 0;
        xlsWriteLabel(\$tablehead, \$kolomhead++, \"No\");";
foreach ($non_pk as $row) {
        $column_name = label($row['column_name']);
        $string .= "\n\txlsWriteLabel(\$tablehead, \$kolomhead++, \"$column_name\");";
}
$string .= "\n\n\tforeach (\$this->" . $m . "->get_all() as \$data) {
            \$kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber(\$tablebody, \$kolombody++, \$nourut);";
foreach ($non_pk as $row) {
        $column_name = $row['column_name'];
        $xlsWrite = $row['data_type'] == 'int' || $row['data_type'] == 'double' || $row['data_type'] == 'decimal' ? 'xlsWriteNumber' : 'xlsWriteLabel';
        $string .= "\n\t    " . $xlsWrite . "(\$tablebody, \$kolombody++, \$data->$column_name);";
}
$string .= "\n\n\t    \$tablebody++;
            \$nourut++;
        }

        xlsEOF();
        exit();
    }";
}

if ($export_word == '1') {
    $string .= "\n\n    public function word() {
        header(\"Content-type: application/vnd.ms-word\");
        header(\"Content-Disposition: attachment;Filename=$table_name.doc\");

        \$data = array(
            '" . $table_name . "_data' => \$this->" . $m . "->get_all(),
            'start' => 0
        );
        
        \$this->viewAdminContent('" . $folder ."/".$c_url ."/". $v_doc . "',\$data);
    }";
}

if ($export_pdf == '1') {
    $string .= "\n\n    function pdf(){
        \$data = array(
            '" . $table_name . "_data' => \$this->" . $m . "->get_all(),
            'start' => 0
        );
        
        ini_set('memory_limit', '32M');
        \$html = \$this->viewAdminContent('" . $c_url ."/". $v_pdf . "', \$data, true);
        \$this->load->library('pdf');
        \$pdf = \$this->pdf->load();
        \$pdf->WriteHTML(\$html);
        \$pdf->Output('" . $table_name . ".pdf', 'D'); 
    }";
}

$string .= "\n\n}";

$hasil_controller = createFile($string, $target . "controllers/" . $c_file);

