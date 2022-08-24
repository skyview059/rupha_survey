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
                    <label for="role_id" class="col-sm-2 control-label">Role Id :<sup>*</sup></label>
                    <div class="col-sm-10">                    
                            <select name="role_id" class="form-control" id="role_id">
                                <?php echo User_lib::getDropDownRoleName($role_id); ?>
                            </select>
                        <?php echo form_error('role_id') ?>
                    </div>
                </div>

                <div id="show_bd_area" <?= (in_array($role_id, [3,4]) ? 'style="display:block;"' : 'style="display:none;"')?>>
                    <div class="form-group">
                        <label for="role_id" class="col-sm-2 control-label">Select Division :<sup>*</sup></label>
                        <div class="col-sm-10">                    
                            <select name="division_id" class="form-control" id="division_id">
                                <?php echo Helper::getDivisions($division_id); ?>
                            </select>
                            <?php echo form_error('division_id') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="role_id" class="col-sm-2 control-label">Select District :<sup>*</sup></label>
                        <div class="col-sm-10">                    
                            <select name="district_id" class="form-control" id="district_id">
                                <?php echo Helper::getDistricts($district_id, $division_id); ?>
                            </select>
                            <?php echo form_error('district_id') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="role_id" class="col-sm-2 control-label">Select Upazila :<sup>*</sup></label>
                        <div class="col-sm-10">                    
                            <select name="upazilla_id" class="form-control" id="upazilla_id">
                                <?php echo Helper::getUpazilas($upazilla_id, $district_id); ?>
                            </select>
                            <?php echo form_error('upazilla_id') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="role_id" class="col-sm-2 control-label">Select Union :<sup>*</sup></label>
                        <div class="col-sm-10">                    
                            <select name="union_id" class="form-control" id="union_id">
                                <?php echo Helper::getUnions($union_id, $upazilla_id); ?>
                            </select>
                            <?php echo form_error('union_id') ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="first_name" class="col-sm-2 control-label">Full Name :<sup>*</sup></label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Full Name" value="<?= $full_name; ?>" />
                        <?php echo form_error('full_name') ?>
                    </div>
                </div>               
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email :<sup>*</sup></label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
                        <?php echo form_error('email') ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="contact" class="col-sm-2 control-label">Contact :<sup>*</sup></label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="contact" id="contact" placeholder="Contact" value="<?php echo $contact; ?>" />
                        <?php echo form_error('contact') ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="status"  class="col-sm-2 control-label">Status :<sup>*</sup></label>
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
<script type="text/javascript">
    $(document.body).on('change', '#division_id' ,function(){
        var division_id = $(this).val();
        jQuery.ajax({
            url: 'user/getDivision/'+division_id,
            type: 'get',
            dataType: "json",
            beforeSend: function () {
                jQuery('#ajax_respond').html('<p class="ajax_processing">Loading....</p>');
            },
            success: function (jsonRespond) {
                
                if(jsonRespond.Status === 'OK'){
                   
                    jQuery('#district_id').html( jsonRespond.Msg );
                } else {
                    jQuery('#ajax_respond').html( jsonRespond.Msg );
                }
            }
        });
    });

    $(document.body).on('change', '#district_id' ,function(){
        var district_id = $(this).val();
        jQuery.ajax({
            url: 'user/getDistrict/'+district_id,
            type: 'get',
            dataType: "json",
            beforeSend: function () {
                jQuery('#ajax_respond').html('<p class="ajax_processing">Loading....</p>');
            },
            success: function (jsonRespond) {
                
                if(jsonRespond.Status === 'OK'){
                   
                    jQuery('#upazilla_id').html( jsonRespond.Msg );
                } else {
                    jQuery('#ajax_respond').html( jsonRespond.Msg );
                }
            }
        });
    });

    $(document.body).on('change', '#upazilla_id' ,function(){
        var upazilla_id = $(this).val();
        jQuery.ajax({
            url: 'user/getUpazilla/'+upazilla_id,
            type: 'get',
            dataType: "json",
            beforeSend: function () {
                jQuery('#ajax_respond').html('<p class="ajax_processing">Loading....</p>');
            },
            success: function (jsonRespond) {
                if(jsonRespond.Status === 'OK'){
                   
                    jQuery('#union_id').html( jsonRespond.Msg );
                } else {
                    jQuery('#ajax_respond').html( jsonRespond.Msg );
                }
            }
        });
    });
</script>