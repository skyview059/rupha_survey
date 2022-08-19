<?php 

$string = "<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php load_module_asset('users','css'); ?>
<section class=\"content-header\">
    <h1>".ucfirst($c_url)."  <small>Delete</small> </h1>
    <ol class=\"breadcrumb\">
        <li><a href=\"<?php echo site_url( Backend_URL )?>\"><i class=\"fa fa-dashboard\"></i> Admin</a></li>";
if( $module_type == 'SubModule'){
    $string .= "\n\t<li><a href=\"<?php echo Backend_URL ?>". strtolower($folder) ."\">". ucfirst($folder)."</a></li>";
}        

$string .= "\n\t<li><a href=\"<?php echo Backend_URL ?>{$tab_link}\">". ucfirst($c_url)."</a></li>
        <li class=\"active\">Delete</li>
    </ol>
</section>

<section class=\"content\">
    <?php echo ".$c_url."Tabs(\$id, 'delete'); ?>
    <div class=\"box no-border\">
        <div class=\"box-header with-border\">
            <h3 class=\"box-title\">Preview Before Delete</h3>
        </div>
        <table class=\"table table-striped\">";
foreach ($non_pk as $row) {
    $string .= "\n\t    <tr><td width=\"150\">".label($row["column_name"])."</td><td width=\"5\">:</td><td><?php echo $".$row["column_name"]."; ?></td></tr>";
}

$string .= "\n\t</table>";
$string .= "\n\t<div class=\"box-header\">";
$string .= "\n\t\t\t <?php echo anchor(site_url(Backend_URL .'". $tab_link ."/delete_action/'.\$id),'<i class=\"fa fa-fw fa-trash\"></i> Confrim Delete ', 'class=\"btn btn-danger\" onclick=\"javasciprt: return confirm(\\'Are You Sure ?\\')\"'); ?>";
$string .= "\n\t</div>";
$string .= "\n\t</div>";
$string .= "</section>";



$hasil_view_delete = createFile($string, $target . "views/$c_url/" . $v_delete_file);

