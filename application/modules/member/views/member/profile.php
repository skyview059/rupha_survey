<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php load_module_asset('user', 'css'); ?>
<section class="content-header">
    <h1>Member  <small>Read</small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(Backend_URL) ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="<?php echo site_url(Backend_URL . 'member') ?>">Member</a></li>
        <li class="active">Details</li>
    </ol>
</section>

<section class="content">
    <?php echo memberTabs($id, 'profile'); ?>
    <div class="box no-border">

        <div class="box-header with-border">
            <h3 class="box-title">Details View</h3>
            <?php echo $this->session->flashdata('message'); ?>
        </div>
        <div class="box-body">
            <div class="row">
                               
                <div class="col-sm-6">
                    <table class="table table-bordered table-striped">
                        <tr><td width="150">Ref ID</td><td width="5">:</td><td><?php echo memberID($ref_id); ?></td></tr>                        
                        <tr><td>Member Name</td><td>:</td><td><?php echo $name; ?></td></tr>                        
                        <tr><td>Contact</td><td>:</td><td><?php echo $contact; ?></td></tr>
                        <tr><td>Address Line1</td><td>:</td><td><?php echo nl2br($address); ?></td></tr>                                                                
                        <tr><td>Registration Date</td><td>:</td><td><?php echo $join_date; ?></td></tr>                                                                
                        <tr><td>Remark</td><td>:</td><td><?php echo $remark; ?></td></tr>
                        <tr><td>Status</td><td>:</td><td><?php echo $status; ?></td></tr>
                    </table>
                </div>
                <div class="col-md-4">                    
                    <div class="thumbnail">                     
                        <img src="<?php echo getPhoto($photo); ?>" class="img-responsive">
                    </div>
                </div> 
            </div>
        </div>
    </div>
</section>