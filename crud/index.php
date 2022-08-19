<?php
//error_reporting(1);
//require_once 'license.php';
require_once 'core/harviacode.php';
require_once 'core/helper.php';
require_once 'core/process.php';


$get_setting    = readJSON('core/settingjson.cfg');
$target         = $get_setting->target;
        
?>
<!doctype html>
<html>
    <head>
        <title>Codeigniter CRUD Generator</title>
        <link rel="stylesheet" href="core/bootstrap.min.css"/>
        <style>
            body{
                padding: 15px;
            }
            label {
                cursor: pointer;
            }
        </style>
    </head>
    <body>
        <div class="row">
            <center>
                <h3>Customized HMVC Pattern Coder <br/><small><em>Only for Flick Base App</em></small></h3>
                <p style="color:red;"><b>Code output path <?php echo $target; ?></b></p>
            </center>
            
            <div class="col-md-6 col-md-offset-3">
                
                <form action="index.php" method="POST">

                    <div class="form-group">
                        <label>Select Table - <a href="<?php echo $_SERVER['PHP_SELF'] ?>">Refresh</a></label>
                        <select id="table_name" name="table_name" class="form-control" onchange="setname()">
                            <option value="">Please Select</option>
                            <?php
                                $table_list = $hc->table_list();
                                $table_list_selected = isset($_POST['table_name']) ? $_POST['table_name'] : '';
                                $html = '';
                                foreach ($table_list as $table) {                                 
                                    $html .= '<option value="'. $table['table_name'] .'"';
                                    $html .= ($table_list_selected == $table['table_name']) ? ' selected="selected"' : '';
                                    $html .= '>'. $table['table_name'] .'</option>';                                
                                }                            
                                echo $html;
                            ?>
                        </select>
                    </div>

                    
                    
                    <!--   Tab Setting: Yes,  No-->
                    <div class="row">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Table Type</label>
                            <div class="col-md-9">
                                <?php 
                                
                                $jenis_tabel = isset($_POST['jenis_tabel']) 
                                                ? $_POST['jenis_tabel'] 
                                                : 'reguler_table';

                                echo htmlRadio('jenis_tabel', $jenis_tabel, [
                                    'reguler_table' => 'Regular',
                                    'datatables' => 'Datatables',
                                    'single' => 'Single Page',
                                ]);?> 
                            </div>
                        </div>
                    </div>
                    
                    
                    <!--   Tab Setting: Yes,  No-->
                    <div class="row">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Need Tab View</label>
                            <div class="col-md-9">                                
                                <?php 
                                
                                $tab_view = isset($_POST['tab_view']) ? $_POST['tab_view'] : 'Yes';
                                echo htmlRadio('tab_view', $tab_view, [
                                    'No' => 'No',
                                    'Yes' => 'Yes'
                                ]);?>                                                                 
                            </div>
                        </div>
                    </div>
                    
                    <!--   Tab Setting: Yes,  No-->
                    <div class="row">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Module Type</label>
                            <div class="col-md-9">                                
                                <?php 
                                $module_type = isset($_POST['module_type']) ? $_POST['module_type'] : 'MainModule';
                                echo htmlRadio('module_type', $module_type, [
                                    'MainModule' => 'Main Module',
                                    'SubModule'  => 'Sub Module'
                                ]);?>                                                                 
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="checkbox">
                            <?php $export_excel = isset($_POST['export_excel']) ? $_POST['export_excel'] : ''; ?>
                            <label>
                                <input type="checkbox" name="export_excel" value="1" <?php echo $export_excel == '1' ? 'checked' : '' ?>>
                                Export Excel
                            </label>
                        </div>
                    </div>    

                    <div class="form-group">
                        <div class="checkbox">
                            <?php $export_word = isset($_POST['export_word']) ? $_POST['export_word'] : ''; ?>
                            <label>
                                <input type="checkbox" name="export_word" value="1" <?php echo $export_word == '1' ? 'checked' : '' ?>>
                                Export Word
                            </label>
                        </div>
                    </div>    

                    <!--                    
                    <div class="form-group">
                                            <div class="checkbox  <?php // echo file_exists('../application/third_party/mpdf/mpdf.php') ? '' : 'disabled';   ?>">
                    <?php // $export_pdf = isset($_POST['export_pdf']) ? $_POST['export_pdf'] : ''; ?>
                                                <label>
                                                    <input type="checkbox" name="export_pdf" value="1" <?php // echo $export_pdf == '1' ? 'checked' : ''   ?>
                    <?php // echo file_exists('../application/third_party/mpdf/mpdf.php') ? '' : 'disabled'; ?>>
                                                    Export PDF
                                                </label>
                    <?php // echo file_exists('../application/third_party/mpdf/mpdf.php') ? '' : '<small class="text-danger">mpdf required, download <a href="http://harviacode.com">here</a></small>'; ?>
                          </div>
                                        
                    </div>
                    -->


                    <div class="form-group">
                        <label>Folder Name</label>
                        <input type="text" id="folder" name="folder" value="<?php echo isset($_POST['folder']) ? $_POST['folder'] : '' ?>" class="form-control" placeholder="Module Name" />
                    </div>
                    
                    <div class="form-group">
                        <label>Custom Controller Name</label>
                        <input type="text" id="controller" name="controller" value="<?php echo isset($_POST['controller']) ? $_POST['controller'] : '' ?>" class="form-control" placeholder="Controller Name" />
                    </div>
                    
                    <div class="form-group">
                        <label>Custom Model Name</label>
                        <input type="text" id="model" name="model" value="<?php echo isset($_POST['model']) ? $_POST['model'] : '' ?>" class="form-control" placeholder="Controller Name" />
                    </div>
                    <input type="submit" value="Generate" name="generate" class="btn btn-primary" onclick="javascript: return confirm('This will overwrite the existing files. Continue ?')" />
                    <input type="submit" value="Generate All" name="generateall" class="btn btn-danger hidden" onclick="javascript: return confirm('WARNING !! This will generate code for ALL TABLE and overwrite the existing files\
                    \nPlease double check before continue. Continue ?')" />
                    <a class="hidden" href="core/setting.php" class="btn btn-default">Setting</a>
                </form>
                <br>

                <?php
                foreach ($hasil as $h) {
                    echo '<p>' . $h . '</p>';
                }
                ?>
            </div> 
        </div>
        <script type="text/javascript">
            function capitalize(s) {
                return s && s[0].toUpperCase() + s.slice(1);
            }

            function setname() {
                var table_name = document.getElementById('table_name').value.toLowerCase();
                if (table_name !== '') {
                    document.getElementById('folder').value = capitalize(table_name);
                    document.getElementById('controller').value = capitalize(table_name);
                    document.getElementById('model').value = capitalize(table_name) + '_model';
                } else {
                    document.getElementById('controller').value = '';
                    document.getElementById('model').value = '';
                }
            }
        </script>
    </body>
</html>
