<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php load_module_asset('user', 'css'); ?>
<section class="content-header">
    <h1>Member<small><?php echo $button ?></small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="<?php echo Backend_URL ?>subscriber">Member</a></li>
        <li class="active">Update</li>
    </ol>
</section>

<section class="content">
    <?php echo memberTabs($id, 'update'); ?>
    <div class="box no-border">
        <div class="box-header with-border">
            <h3 class="box-title">Update Member</h3>
            <?php echo $this->session->flashdata('message'); ?>
        </div>


        <div class="box-body">
            <form class="form-horizontal" action="<?php echo $action; ?>" enctype="multipart/form-data" method="post">            

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ref_id" class="col-sm-3 control-label"><sup>*</sup>  Ref. ID:</label>
                        <div class="col-sm-3">                    
                            <input type="text" class="form-control" name="ref_id" id="ref_id" placeholder="Ref.ID" value="<?php echo $ref_id; ?>" />                  
                            <?php echo form_error('ref_id') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label"><sup>*</sup> Member Name:</label>
                            <div class="col-sm-9">                    
                            <input type="text" class="form-control" name="name" id="name" placeholder="Member Name" value="<?php echo $name; ?>" />
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
                        <label for="reg_date" class="col-sm-3 control-label"><sup>*</sup> Registration Date:</label>
                        <div class="col-sm-3">
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
                        <label for="remark" class="col-sm-3 control-label">Remark:</label>
                        <div class="col-sm-9">                    
                            <textarea class="form-control" name="remark" id="remark" placeholder="Remark"><?php echo $remark; ?></textarea>
                            <?php echo form_error('remark') ?>
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

                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="hidden" name="old_photo" value="<?php echo $photo; ?>" /> 
                        <div class="thumbnail upload_image">                     
                            <img src="<?php echo getPhoto($photo); ?>" class="img-responsive">
                        </div>

                        <div class="btn btn-default btn-block btn-file">
                            <i class="fa fa-picture-o"></i> Select Photo to Change Profile Picture
                            <input type="file" name="photo" class="file_select" onchange="instantPhotoPreview(this, '.upload_image')">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-12 no-padding">
                            <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                            <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                            <a href="<?php echo site_url(Backend_URL . 'member') ?>" class="btn btn-default">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php echo form_close(); ?>
        </div>    
    </div>
</section>