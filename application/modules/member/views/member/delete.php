<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php load_module_asset('user', 'css'); ?>
<section class="content-header">
    <h1>Member  <small>Delete</small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(Backend_URL) ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="<?php echo Backend_URL ?>subscriber">Member</a></li>
        <li class="active">Delete</li>
    </ol>
</section>

<section class="content">
    <?php echo memberTabs($id, 'delete'); ?>
    <div class="box no-border">
        <div class="box-header with-border">
            <h3 class="box-title">Preview Before Delete</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-striped">
                <tr><td width="150">Ref ID</td><td width="5">:</td><td><?php echo $ref_id; ?></td></tr>               
                <tr><td>Member Name</td><td>:</td><td><?php echo $name; ?></td></tr>                
                                
                <tr><td>Contact</td><td>:</td><td><?php echo $contact; ?></td></tr>
                <tr><td>Address</td><td>:</td><td><?php echo $address; ?></td></tr>	    	    	    	    
            </table>
        </div>
        <div class="box-header">
            <?php            
                if($bill_record){
                    
                    echo '<p class="alert alert-warning">';
                    echo '<i class="fa fa-warning"></i> ';
                    echo "This subscriber has {$bill_record} bill record(s). So 'Delete' is not accept.";
                    echo '</p>';
                    
                    if($force){
                        echo anchor(
                            site_url(Backend_URL . 'member/force_delete/' . $id), 
                            '<i class="fa fa-fw fa-trash"></i> Confrim Delete ', 
                            'class="btn btn-danger" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'
                        );
                    }
                    
                    
                } else {
                    echo anchor(
                        site_url(Backend_URL . 'member/delete_action/' . $id), 
                        '<i class="fa fa-fw fa-trash"></i> Confrim Delete ', 
                        'class="btn btn-danger" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'
                    );
                }
            
                
            ?>
        </div>
    </div>
</section>