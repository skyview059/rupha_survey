<?php 
$string = "<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class=\"content-header\">
    <h1> ". ucfirst($c_url)."  <small>Control panel</small> <?php echo anchor(site_url( Backend_URL . '".$redirect_link."/create'),' + Add New', 'class=\"btn btn-default\"'); ?> </h1>
    <ol class=\"breadcrumb\">
        <li><a href=\"<?php echo site_url( Backend_URL )?>\"><i class=\"fa fa-dashboard\"></i> Admin</a></li>";
if( $module_type == 'SubModule'){
    $string .= "\n\t<li><a href=\"<?php echo Backend_URL ?>". strtolower($folder) ."\">". ucfirst($folder)."</a></li>";
}        
$string .= "\n\t<li class=\"active\">". ucfirst($c_url)."</li>
    </ol>
</section>

<section class=\"content\">       
    <div class=\"box\">            
        <div class=\"box-header with-border\">                                   
            <div class=\"col-md-3 col-md-offset-9 text-right\">
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
            <table class=\"table table-hover table-condensed\">
                <thead>
                    <tr>
                    \t<th width=\"40\">S/L</th>";
         foreach ($non_pk as $row) {
            $string .= "\n\t\t<th>" . label($row['column_name']) . "</th>";
        }
        $string .= "\n\t\t<th width=\"200\">Action</th>
                    </tr>
                </thead>\n
                <tbody>\n";
        $string .= "\t<?php foreach (\${$c_url}s as \$$c_url) { ?>
                    <tr>";

        $string .= "\n\t\t<td><?php echo ++\$start ?></td>";
        foreach ($non_pk as $row) {
            $string .= "\n\t\t<td><?php echo \${$c_url}->{$row['column_name']}; ?></td>";
        }


        $string .= "\n\t\t<td>"
                . "\n\t\t\t<?php "
                . "\n\t\t\techo anchor(site_url(Backend_URL .'{$redirect_link}/read/'.\${$c_url}->{$pk}),'<i class=\"fa fa-fw fa-external-link\"></i> View', 'class=\"btn btn-xs btn-primary\"'); "
                . "\n\t\t\techo anchor(site_url(Backend_URL .'{$redirect_link}/update/'.\${$c_url}->{$pk}),'<i class=\"fa fa-fw fa-edit\"></i> Edit',  'class=\"btn btn-xs btn-warning\"'); "        
                . "\n\t\t\techo anchor(site_url(Backend_URL .'{$redirect_link}/delete/'.\${$c_url}->{$pk}),'<i class=\"fa fa-fw fa-trash\"></i> Delete ', 'class=\"btn btn-xs btn-danger\"'); "
                . "\n\t\t\t?>"
                . "\n\t\t</td>
                    </tr>
                <?php } ?>
                    </tbody>
                </table>
            </div>
        
        
            <div class=\"row\">                
                <div class=\"col-md-6\">
                    <span class=\"btn btn-primary\">Total ". ucfirst($folder).": <?php echo \$total_rows ?></span>";
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
</section>";


$hasil_view_list = createFile($string, $target.  "views/$c_url/" . $v_list_file);

