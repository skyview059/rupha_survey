<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="content-header">
    <h1> User  <small><?php echo $button ?></small> <a href="<?php echo site_url(Backend_URL . 'user') ?>" class="btn btn-default">Back</a> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="<?php echo Backend_URL ?>user">User</a></li>
        <li class="active">Add New</li>
    </ol>
</section>

<section class="content">       
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Add New User</h3>
        </div>

        <div class="box-body">
            <?php echo form_open($action, array('class' => 'form-horizontal', 'method' => 'post')); ?>
            <div class="form-group">
                <label for="role_id" class="col-sm-2 control-label">Select Role :</label>
                <div class="col-sm-10">                    
                    <select name="role_id" class="form-control" id="role_id">
                        <?php echo User_lib::getDropDownRoleName($role_id); ?>
                    </select>
                    <?php echo form_error('role_id') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="role_id" class="col-sm-2 control-label">Select Division :</label>
                <div class="col-sm-10">                    
                    <select name="division_id" class="form-control" id="division_id">
                        <?php echo Helper::getDivisions($division_id); ?>
                    </select>
                    <?php echo form_error('division_id') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="role_id" class="col-sm-2 control-label">Select District :</label>
                <div class="col-sm-10">                    
                    <select name="district_id" class="form-control" id="district_id">
                        <?php echo Helper::getDistricts($district_id); ?>
                    </select>
                    <?php echo form_error('district_id') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="role_id" class="col-sm-2 control-label">Select Upazila :</label>
                <div class="col-sm-10">                    
                    <select name="upazilla_id" class="form-control" id="upazilla_id">
                        <?php echo Helper::getUpazilas($upazilla_id); ?>
                    </select>
                    <?php echo form_error('upazilla_id') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="role_id" class="col-sm-2 control-label">Select Union :</label>
                <div class="col-sm-10">                    
                    <select name="union_id" class="form-control" id="union_id">
                        <?php echo Helper::getUnions($union_id); ?>
                    </select>
                    <?php echo form_error('union_id') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="full_name" class="col-sm-2 control-label">Full Name :</label>
                <div class="col-sm-10">                    
                    <input type="text" class="form-control" name="full_name" id="full_name" placeholder="First Name" value="<?php echo $full_name; ?>" />
                    <?php echo form_error('full_name') ?>
                </div>
            </div>
            
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email :</label>
                <div class="col-sm-10">                    
                    <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?= $email; ?>" />
                    <?php echo form_error('email') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Password :</label>
                <div class="col-sm-10">                    
                    <input type="text" class="form-control" name="password" id="password" value="<?= $password; ?>" />
                    <?php echo form_error('password') ?>
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
                <div class="col-md-10 col-md-offset-2" style="padding-left:5px;">
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                    <a href="<?php echo site_url(Backend_URL . 'user') ?>" class="btn btn-default">Cancel</a>
                </div>
            </div>
            <?php echo form_close(); ?>>
        </div>
    </div>
</section>