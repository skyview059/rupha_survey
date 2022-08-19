<?php 

$string = "<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php load_module_asset('users','css'); ?>
<section class=\"content-header\">
    <h1>".ucfirst($c_url)."  <small>Read</small> </h1>
    <ol class=\"breadcrumb\">
        <li><a href=\"<?php echo site_url( Backend_URL )?>\"><i class=\"fa fa-dashboard\"></i> Admin</a></li>";
if( $module_type == 'SubModule'){
    $string .= "\n\t<li><a href=\"<?php echo Backend_URL ?>". strtolower($folder) ."\">". ucfirst($folder)."</a></li>";
}        
$string .= "\n\t<li><a href=\"<?php echo site_url( Backend_URL .'{$tab_link}' )?>\">". ucfirst($c_url)."</a></li>
        <li class=\"active\">Details</li>
    </ol>
</section>

<section class=\"content\">
    <?php echo ".$c_url."Tabs(\$id, 'read'); ?>
    <div class=\"box no-border\">
        
        <div class=\"box-header with-border\">
            <h3 class=\"box-title\">Details View</h3>
            <?php echo \$this->session->flashdata('message'); ?>
        </div>
        <table class=\"table table-striped\">";
foreach ($non_pk as $row) {
    $string .= "\n\t    <tr><td width=\"150\">".label($row["column_name"])."</td><td width=\"5\">:</td><td><?php echo $".$row["column_name"]."; ?></td></tr>";
}
$string .= "\n\t    <tr><td></td><td></td><td>"
        . "<a href=\"<?php echo site_url( Backend_URL .'".$redirect_link."') ?>\" class=\"btn btn-default\"><i class=\"fa fa-long-arrow-left\"></i> Back</a>"
        . "<a href=\"<?php echo site_url( Backend_URL .'".$redirect_link."/update/'.\$id ) ?>\" class=\"btn btn-primary\"> <i class=\"fa fa-edit\"></i> Edit</a>"
        . "</td></tr>";
$string .= "\n\t</table>";
$string .= "\n\t</div>";
$string .= "</section>";



$hasil_view_read = createFile($string, $target . "views/$c_url/" . $v_read_file);

