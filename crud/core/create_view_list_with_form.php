<?php 
$string = "<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class=\"content-header\">
    <h1> ". ucfirst($c_url)."  <small>Control panel</small> </h1>
    <ol class=\"breadcrumb\">
        <li><a href=\"<?php echo site_url( Backend_URL )?>\"><i class=\"fa fa-dashboard\"></i> Admin</a></li>";
if( $module_type == 'SubModule'){
    $string .= "\n\t<li><a href=\"<?php echo Backend_URL ?>". strtolower($folder) ."\">". ucfirst($folder)."</a></li>";
}        
$string .= "\n\t<li class=\"active\">". ucfirst($c_url)."</li>
    </ol>
</section>

<section class=\"content\">
    
    <div class=\"row\">
        <div class=\"col-md-4 col-xs-12\">            
            <div class=\"box box-primary\">                
                <div class=\"box-header with-border\">
                    <h3 class=\"box-title\">
                        <i class=\"fa fa-plus\" aria-hidden=\"true\"></i> Add New
                    </h3>
                </div>

                <div class=\"box-body\">
                    <div style=\"padding:0 15px;\">
                        <?php echo form_open( Backend_URL . '{$tab_link}/create_action', array('class'=>'form-horizontal', 'method'=>'post')); ?>";

                            foreach ($non_pk as $row) {
                                if ($row["data_type"] == 'text' or $row["data_type"] == 'longtext'){
                            $string .= "\n\t<div class=\"form-group\">
                                        <label for=\"".$row["column_name"]."\">".label($row["column_name"])."</label>
                                <textarea class=\"form-control\" rows=\"3\" name=\"{$row["column_name"]}\" id=\"{$row["column_name"]}\" placeholder=\"".label($row["column_name"])."\"></textarea>
                                    </div>";
                                } elseif ($row["data_type"] == 'enum'){
                                    $name      = $row['column_name'];                                    
                                    $data      = $hc->get_enum_value($table_name,$name);
                                    $default   = $data['Default'];
                                    $array_str = $data['Enum'];
                                    
                                    
                            $string .= "\n\t<div class=\"form-group\" style=\"padding-top:8px;\">
                                            <label for=\"{$name}\">". label($name). "</label><br/>
                                            <?php echo htmlRadio('{$name}','{$default}',{$array_str});  ?>                                          
                                    </div>";
                                } else {
                            $string .= "\n\t<div class=\"form-group\">
                                        <label for=\"{$row["column_name"]}\">".label($row["column_name"])."</label>
                                        <input type=\"text\" class=\"form-control\" name=\"{$row["column_name"]}\" id=\"{$row["column_name"]}\" placeholder=\"".label($row["column_name"])."\" />
                                    </div>";
                                }
                            }        
                            $string .= "\n\t <button type=\"submit\" class=\"btn btn-primary\">Save New</button> ";
                            $string .= "\n\t <a href=\"<?php echo site_url('".$c_url."') ?>\" class=\"btn btn-default\">Reset</a>";
                            $string .= "\n\t<?php echo form_close(); ?>

                    </div>                    
                </div>    
            </div>
        </div>

        <div class=\"col-md-8 col-xs-12\">
        
            <div class=\"box box-primary\">            
                <div class=\"box-header with-border\">                                   
                    <div class=\"col-md-5 col-md-offset-7 text-right\">
                        <form action=\"<?php echo site_url( Backend_URL .'$tab_link'); ?>\" class=\"form-inline\" method=\"get\">
                            <div class=\"input-group\">
                                <input type=\"text\" class=\"form-control\" name=\"q\" value=\"<?php echo \$q; ?>\">
                                <span class=\"input-group-btn\">
                                    <?php if (\$q <> '') { ?>
                                        <a href=\"<?php echo site_url( Backend_URL .'$tab_link'); ?>\" class=\"btn btn-default\">Reset</a>
                                    <?php } ?>
                                    <button class=\"btn btn-primary\" type=\"submit\">Search</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>

                <div class=\"box-body\">
                    <?php echo \$this->session->flashdata('message'); ?>
                    <div class=\"table-responsive\">
                    <table class=\"table table-bordered table-striped table-condensed\">
                        <thead>
                            <tr>
                            \t<th width=\"40\">ID</th>";
                            foreach ($non_pk as $row) {
                                $string .= "\n\t\t<th>" . label($row['column_name']) . "</th>";
                            }
                            $string .= "\n\t\t<th width=\"90\">Action</th>
                            </tr>
                        </thead>\n
                        <tbody>\n";
                        $string .= "\t<?php foreach ($" . $c_url . " as \$$c_url) { ?>
                                    <tr>";
                        $string .= "\n\t\t<td><?php echo ++\$start ?></td>";
                        foreach ($non_pk as $row) {
                            $string .= "\n\t\t<td><?php echo $" . $c_url ."->". $row['column_name'] . " ?></td>";
                        }


                $string .= "\n\t\t<td>"
                        . "\n\t\t\t<?php "                        
                        . "\n\t\t\techo anchor(site_url(Backend_URL .'".$redirect_link."/update/'.$".$c_url."->".$pk."),'<i class=\"fa fa-fw fa-edit\"></i>',  'class=\"btn btn-xs btn-default\" title=\"Edit\"'); "        
                        . "\n\t\t\techo anchor(site_url(Backend_URL .'".$redirect_link."/delete_action/'.$".$c_url."->".$pk."),'<i class=\"fa fa-fw fa-trash\"></i>', 'onclick=\"return confirm(\'Confirm Delete\')\" class=\"btn btn-xs btn-danger\" title=\"Delete\"'); "
                        . "\n\t\t\t?>"
                        . "\n\t\t</td>
                            </tr>
                        <?php } ?>
                            </tbody>
                        </table>
                    </div>


                    <div class=\"row\">                
                        <div class=\"col-md-6\">
                            <span class=\"btn btn-primary\">Total Record : <?php echo \$total_rows ?></span>";
                            if ($export_excel == '1') {
                                $string .= "\n\t\t<?php echo anchor(site_url(Backend_URL .'".$redirect_link."/excel'), 'Excel', 'class=\"btn btn-primary\"'); ?>";
                            }
                            if ($export_word == '1') {
                                $string .= "\n\t\t<?php echo anchor(site_url(Backend_URL .'".$redirect_link."/word'), 'Word', 'class=\"btn btn-primary\"'); ?>";
                            }
                            if ($export_pdf == '1') {
                                $string .= "\n\t\t<?php echo anchor(site_url(Backend_URL .".$redirect_link."/pdf'), 'PDF', 'class=\"btn btn-primary\"'); ?>";
                            }
                            $string .= "\n\t    
                        </div>
                        <div class=\"col-md-6 text-right\">
                            <?php echo \$pagination ?>
                        </div>                
                    </div>
                </div>
            </div>
        </div>   
    </div>
</section>";


$hasil_view_list = createFile($string, $target.  "views/$c_url/" . $v_list_file);

