<?php 

$string = "<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class=\"content-header\">
    <h1> ". ucfirst($c_url)."  <small><?php echo \$button ?></small> <a href=\"<?php echo site_url( Backend_URL .'".$tab_link."') ?>\" class=\"btn btn-default\">Back</a> </h1>
    <ol class=\"breadcrumb\">
        <li><a href=\"<?php echo Backend_URL ?>\"><i class=\"fa fa-dashboard\"></i> Admin</a></li>";
        
if( $module_type == 'SubModule'){
    $string .= "\n\t<li><a href=\"<?php echo Backend_URL ?>". strtolower($folder) ."\">". ucfirst($folder)."</a></li>";
}

$string .= "\n\t<li><a href=\"<?php echo Backend_URL ?>{$tab_link}\">". ucfirst($c_url)."</a></li>
        <li class=\"active\">Add New</li>
    </ol>
</section>

<section class=\"content\">       
    <div class=\"box\">
        <div class=\"box-header with-border\">
            <h3 class=\"box-title\">Create New ". ucfirst($table_name)."</h3>
        </div>
        
        <div class=\"box-body\">
        <?php echo form_open( \$action, array('class'=>'form-horizontal', 'method'=>'post')); ?>";
                
        foreach ($non_pk as $row) {
            if ($row["data_type"] == 'text' or $row["data_type"] == 'longtext'){
            $string .= "\n\t    <div class=\"form-group\">        
                    <label for=\"".$row["column_name"]."\" class=\"col-sm-2 control-label\">".label($row["column_name"])." :</label>
                    <div class=\"col-sm-10\">
                        <textarea class=\"form-control\" rows=\"3\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($row["column_name"])."\"><?php echo $".$row["column_name"]."; ?></textarea>
                        <?php echo form_error('".$row["column_name"]."') ?>
                    </div>
                </div>";
            } elseif ($row["data_type"] == 'enum'){
                $name      = $row['column_name'];                                    
                $data      = $hc->get_enum_value($table_name,$name);                
                $array_str = $data['Enum'];


                $string .= "\n\t<div class=\"form-group\">
                        <label for=\"{$name}\"  class=\"col-sm-2 control-label\">". label($name). " :</label>
                        <div class=\"col-sm-10\"  style=\"padding-top:8px;\"><?php echo htmlRadio('{$name}',\${$name},{$array_str});  ?></div>
                </div>";
            } else {
            $string .= "\n\t    <div class=\"form-group\">
                    <label for=\"".$row["column_name"]."\" class=\"col-sm-2 control-label\">".label($row["column_name"])." :</label>
                    <div class=\"col-sm-10\">                    
                        <input type=\"text\" class=\"form-control\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($row["column_name"])."\" value=\"<?php echo $".$row["column_name"]."; ?>\" />
                        <?php echo form_error('".$row["column_name"]."') ?>
                    </div>
                </div>";
            }
        }
        
$string .= "\n\t<div class=\"col-md-12 text-right\">";
$string .= "\n\t    <input type=\"hidden\" name=\"".$pk."\" value=\"<?php echo $".$pk."; ?>\" /> ";
$string .= "\n\t    <button type=\"submit\" class=\"btn btn-primary\"><?php echo \$button ?></button> ";
$string .= "\n\t    <a href=\"<?php echo site_url( Backend_URL .'".$redirect_link."') ?>\" class=\"btn btn-default\">Cancel</a>";
$string .= "\n\t</div>";
$string .= "\n</form>";
$string .= "\n\t</div></div></section>";

$hasil_view_form = createFile($string, $target.  "views/$c_url/" . $v_form_file);

