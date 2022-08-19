<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php load_module_asset('user', 'css'); ?>
<section class="content-header">
    <h1>User<small><?php echo $button ?></small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="<?php echo Backend_URL ?>user">User</a></li>
        <li class="active">Update</li>
    </ol>
</section>

<section class="content"><?php echo userTabs($id, 'update'); ?><div class="box no-border">
        <div class="box-header with-border">
            <h3 class="box-title">Update User</h3>
            <?php echo $this->session->flashdata('message'); ?>
        </div>

        <div class="box-body">
            <form class="form-horizontal" action="<?php echo $action; ?>" method="post">
                <div class="form-group">
                    <label for="role_id" class="col-sm-2 control-label">Role Id :</label>
                    <div class="col-sm-10">                    
                            <select name="role_id" class="form-control" id="role_id">
                                <?php echo User_lib::getDropDownRoleName($role_id); ?>
                            </select>
                        <?php echo form_error('role_id') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="first_name" class="col-sm-2 control-label">Full Name :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Full Name" value="<?= $full_name; ?>" />
                        <?php echo form_error('full_name') ?>
                    </div>
                </div>               
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
                        <?php echo form_error('email') ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="contact" class="col-sm-2 control-label">Contact :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="contact" id="contact" placeholder="Contact" value="<?php echo $contact; ?>" />
                        <?php echo form_error('contact') ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="status"  class="col-sm-2 control-label">Status :</label>
                    <div class="col-sm-10"  style="padding-top:8px;">
                        <?php echo htmlRadio('status', $status, array('Active' => 'Active', 'Inactive' => 'Inactive')); ?>
                        
                        <?php echo form_error('status') ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-10 col-md-offset-2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                        <a href="<?php echo site_url(Backend_URL . 'user') ?>" class="btn btn-default">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>