<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="content-header">
    <h1> Member  <small><?php echo $button ?></small> <a href="<?php echo site_url(Backend_URL . 'member') ?>" class="btn btn-default">Back</a> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="<?php echo Backend_URL ?>subscriber">Member</a></li>
        <li class="active">Add New</li>
    </ol>
</section>

<section class="content">       
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-user-plus"></i> Member Registration Form</h3>
        </div>

        <div class="box-body">


            <form class="form-horizontal" action="<?php echo $action; ?>" enctype="multipart/form-data" method="post">            

                <div class="row">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="ref_id" class="col-sm-3 control-label"><sup>*</sup>  Ref. ID:</label>
                            <div class="col-sm-4">                    
                                <input type="text" class="form-control" name="ref_id" id="ref_id" placeholder="Ref.ID" value="<?php echo $ref_id; ?>" />                  
                                <?php echo form_error('ref_id') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label"><sup>*</sup> Name:</label>
                            <div class="col-sm-9">                    
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>" />
                                <?php echo form_error('name') ?>
                            </div>
                        </div>                        

                        <div class="form-group">
                            <label for="contact" class="col-sm-3 control-label"> Contact:</label>
                            <div class="col-sm-9">  
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i> +88</span>
                                    <input type="number" class="form-control" maxlength="11" name="contact" id="contact" placeholder="Contact" value="<?php echo $contact; ?>" />
                                    <span class="input-group-addon">11 Digit Number</span>
                                </div>
                                <?php echo form_error('contact') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="add_line1" class="col-sm-3 control-label">Address:</label>
                            <div class="col-sm-9">                    
                                <textarea class="form-control" name="address" id="address" placeholder="Full Address"><?php echo $address; ?></textarea>
                                <?php echo form_error('address') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="reg_date" class="col-sm-3 control-label"><sup>*</sup> Join Date:</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>                     
                                    <input type="text" class="form-control js_datepicker"  
                                           name="join_date" id="join_date" placeholder="Join Date" 
                                           value="<?php echo $join_date; ?>" />
                                </div>
                                <?php echo form_error('join_date') ?>
                            </div>
                        </div>                

                        <div class="form-group">
                            <label for="status"  class="col-sm-3 control-label">Status:</label>
                            <div class="col-sm-9"  style="padding-top:8px;">
                                <?php
                                echo htmlRadio('status', $status, array(
                                    'Active' => 'Active', 'Inactive' => 'Inactive')
                                );
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="remark" class="col-sm-3 control-label">Remark:</label>
                            <div class="col-sm-9">                    
                                <textarea class="form-control" name="remark" id="remark" placeholder="Remark"><?php echo $remark; ?></textarea>
                                <?php echo form_error('remark') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-9 col-md-offset-3">
                                <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                                
                                <a href="<?php echo site_url(Backend_URL . 'member') ?>" class="btn btn-default">
                                    <i class="fa fa-times"></i> 
                                    Cancel
                                </a>
                                
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i> 
                                    Register & Continue to upload photo
                                </button> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">

                    </div>
                </div>
                <?php echo form_close(); ?>
        </div>    
    </div>
</section>