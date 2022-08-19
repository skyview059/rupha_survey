<?php 
$string = "<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section class=\"content-header\">
    <h1> ". ucfirst($table_name)."  <small>Control panel</small> <?php echo anchor(site_url(Backend_URL.'". $c_url."/create'),' + Add New', 'class=\"btn btn-default\"'); ?> </h1>
    <ol class=\"breadcrumb\">
        <li><a href=\"#\"><i class=\"fa fa-dashboard\"></i> Admin</a></li>
        <li class=\"active\">". ucfirst($table_name)."</li>
    </ol>
</section>

<section class=\"content\">
<div class=\"box\" style=\"margin-bottom: 10px\">
             
        <div class=\"box-header\">          
            <div class=\"col-md-4 text-right\">";                
if ($export_excel == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url(Backend_URL.'". $c_url."/excel'), 'Excel', 'class=\"btn btn-primary\"'); ?>";
}
if ($export_word == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url(Backend_URL.'". $c_url."/word'), 'Word', 'class=\"btn btn-primary\"'); ?>";
}
if ($export_pdf == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url(Backend_URL.'". $c_url."/pdf'), 'PDF', 'class=\"btn btn-primary\"'); ?>";
}
$string .= "\n\t    
            </div>    
        </div>
    
    <div class=\"box-body\">
    <div class=\"table-responsive\">
        <table class=\"table table-bordered table-striped\" id=\"mytable\">
            <thead>
                <tr>
                    <th width=\"20px\">No</th>";
foreach ($non_pk as $row) {
    $string .= "\n\t\t    <th>" . label($row['column_name']) . "</th>";
}
$string .= "\n\t\t    <th width=\"150\">Action</th>
                </tr>
            </thead>";
$string .= "\n\t    <tbody>
            <?php
            \$start = 0;
            foreach ($" . $c_url . "_data as \$$c_url)
            {
                ?>
                <tr>";

$string .= "\n\t\t    <td><?php echo ++\$start ?></td>";

foreach ($non_pk as $row) {
    $string .= "\n\t\t    <td><?php echo $" . $c_url ."->". $row['column_name'] . " ?></td>";
}

$string .= "\n\t\t    <td>"
        . "\n\t\t\t<?php "
        . "\n\t\t\techo anchor(site_url( Backend_URL .'". $c_url."/read/'.$".$c_url."->".$pk."),'<i class=\"fa fa-fw fa-external-link\"></i> View', 'class=\"btn btn-xs btn-default\"'); "        
        . "\n\t\t\techo anchor(site_url( Backend_URL .'". $c_url."/update/'.$".$c_url."->".$pk."),'<i class=\"fa fa-fw fa-edit\"></i> Edit',  'class=\"btn btn-xs btn-default\"'); "
        . "\n\t\t\techo anchor(site_url( Backend_URL .'". $c_url."/delete/'.$".$c_url."->".$pk."),'<i class=\"fa fa-fw fa-trash\"></i> Delete ', 'class=\"btn btn-xs btn-danger\" onclick=\"javasciprt: return confirm(\\'Are You Sure ?\\')\"'); "
        . "\n\t\t\t?>"
        . "\n\t\t    </td>";

$string .=  "\n\t        </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    </div>
</div>
</section>
        
        <script type=\"text/javascript\">
            $(document).ready(function () {
                $(\"#mytable\").dataTable();
            });
        </script>";


$hasil_view_list = createFile($string, $target . "views/" . $v_list_file);
