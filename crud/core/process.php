<?php

$hasil = array();

if (isset($_POST['generate'])){
    // get form data
    $table_name     = safe($_POST['table_name']);
    $jenis_tabel    = safe($_POST['jenis_tabel']);
    $export_excel   = isset($_POST['export_excel']) ? safe($_POST['export_excel']) : false;
    $export_word    = isset($_POST['export_word'])  ? safe($_POST['export_word']) : false;
    $export_pdf     = isset($_POST['export_pdf'])   ? safe($_POST['export_pdf']) : false;
    
    $folder         = strtolower(safe($_POST['folder']));
    $controller     = safe($_POST['controller']);
    $model          = safe($_POST['model']);
    $module_type    = safe($_POST['module_type']);
    
    
    
    

    if ($table_name <> ''){
        // set data
        $table_name = $table_name;
        $c = $controller <> '' ? ucfirst($controller) : ucfirst($table_name);
        $m = $model <> '' ? ucfirst($model) : ucfirst($table_name) . '_model';
        $h = strtolower($c) . '_helper';
        
        $v_list = 'index';  // $table_name . "_list";
        $v_read = 'read';   // $table_name . "_read";
        $v_create = 'create';   // $table_name . "_form";
        $v_update = 'update'; // $table_name . "_form";
        $v_delete = 'delete'; // $table_name . "_form";
        $v_doc  = 'doc';    //$table_name . "_doc"
        $v_pdf  = 'pdf';    // $table_name . "_pdf";

        // url
        $c_url = strtolower($c);

        if($module_type == 'SubModule'){
            $redirect_link  = $folder .'/'. $c_url;
            $tab_link       = $folder .'/'. $c_url;
        } else {
            $redirect_link  = $c_url;
            $tab_link       = $c_url;
        }                
        
        
        // filename
        $c_file = $c . '.php';
        $m_file = $m . '.php';
        $h_file = $h . '.php';
       
        $v_list_file = $v_list . '.php';        
        $v_read_file = $v_read . '.php';        
        $v_form_file = $v_create . '.php';
        $v_update_file = $v_update . '.php';
        $v_delete_file = $v_delete . '.php';
        $v_doc_file = $v_doc . '.php';
        $v_pdf_file = $v_pdf . '.php';
        
        //replace _helper from  a helper file
        $h = str_replace('_helper', '', $h);

        // read setting
        $get_setting    = readJSON('core/settingjson.cfg');
        $target         = $get_setting->target . $folder . '/';

//        if (!file_exists($target)){                                    
//           mkdir($target, 0777, true);
//        }
        
        if (!file_exists($target . 'views/' . $c_url)){
            mkdir($target . 'views/' . $c_url, 0777, true);
        }
        
        

        $pk     = $hc->primary_field($table_name);
        $non_pk = $hc->not_primary_field($table_name);
        $all    = $hc->all_field($table_name);
        
        // For Setup Route by folder name
        $module_name = $folder;

        // generate
        include 'core/create_config_pagination.php';
        include 'core/create_view_form.php';
        include 'core/create_view_update.php';
        
        if($module_type == 'MainModule'){ 
            include 'core/create_config_routes.php';
            include 'core/create_controller.php';            
            include 'core/create_view_read.php';            
            include 'core/create_view_delete.php';
            
        } else {
            include 'core/create_controller_single.php';            
        }
        
        
        include 'core/create_model.php';
        include 'core/create_helper.php';        
        
        if($jenis_tabel == 'reguler_table'){
            include 'core/create_view_list.php';
            
        } elseif( $jenis_tabel == 'single' ){
            include 'core/create_view_list_with_form.php'; 
            
        } else {
            include 'core/create_view_list_datatables.php';            
        }        
              

        $export_excel   == 1 ? include 'core/create_exportexcel_helper.php' : '';
        $export_word    == 1 ? include 'core/create_view_list_doc.php' : '';
        $export_pdf     == 1 ? include 'core/create_pdf_library.php' : '';
        $export_pdf     == 1 ? include 'core/create_view_list_pdf.php' : '';

        $hasil[] = $hasil_controller;
        $hasil[] = $hasil_model;
        $hasil[] = $hasil_helper;
        $hasil[] = $hasil_view_list;                
        $hasil[] = $hasil_view_update;
        
        $hasil[] = isset($hasil_view_doc) ? $hasil_view_doc : '';
        $hasil[] = isset($hasil_view_pdf) ? $hasil_view_pdf : '';
        $hasil[] = $hasil_config_pagination;
        
        if($module_type == 'MainModule'){        
            $hasil[] = $hasil_config_routes;
            $hasil[] = $hasil_view_form;
            $hasil[] = $hasil_view_read;            
            $hasil[] = $hasil_view_delete;
        }
        
        $hasil[] = isset($hasil_exportexcel) ? $hasil_exportexcel : '';
        $hasil[] = isset($hasil_pdf) ? $hasil_pdf : '';
    } else{
        $hasil[] = 'No table selected.';
    }
}