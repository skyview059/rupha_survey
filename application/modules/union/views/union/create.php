<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="content-header">
    <h1> Union  <small><?php echo $button ?></small> <a href="<?php echo site_url(Backend_URL . 'union') ?>" class="btn btn-default">Back</a> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="<?php echo Backend_URL ?>union">Union</a></li>
        <li class="active">Add New</li>
    </ol>
</section>

<section class="content">       
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Add New Union</h3>
        </div>

        <div class="box-body">
            <?php echo form_open($action, array('class' => 'form-horizontal', 'method' => 'post')); ?>
            <div class="form-group">
                <label for="division_id" class="col-sm-2 control-label">Division:</label>
                <div class="col-sm-10">                    
                    <select name="division_id" class="form-control" id="division_id">
                        <?php echo Helper::getDivisions($division_id); ?>
                    </select>  
                    <?php echo form_error('upazilla_id') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="district_id" class="col-sm-2 control-label">District:</label>
                <div class="col-sm-10">                    
                     <select name="district_id" class="form-control" id="district_id">
                        <?php echo Helper::getDistricts($district_id, $division_id); ?>
                    </select> 
                    <?php echo form_error('upazilla_id') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="upazilla_id" class="col-sm-2 control-label">Upazilla:</label>
                <div class="col-sm-10">                    
                    <select name="upazilla_id" class="form-control" id="upazilla_id">
                        <?php echo Helper::getUpazilas($upazilla_id, $district_id); ?>
                    </select>
                    <?php echo form_error('upazilla_id') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name English:</label>
                <div class="col-sm-10">                    
                    <input type="text" class="form-control" name="name" id="name" placeholder="English Name" value="<?php echo $name; ?>" />
                    <?php echo form_error('name') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="bn_name" class="col-sm-2 control-label">Name Bangla:</label>
                <div class="col-sm-10">                    
                    <input type="text" class="form-control" name="bn_name" id="bn_name" placeholder="Bangla Name" value="<?php echo $bn_name; ?>" />
                    <?php echo form_error('bn_name') ?>
                </div>
            </div>
            <div class="col-md-10 col-md-offset-2" style="padding-left:5px;">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                <a href="<?php echo site_url(Backend_URL . 'union') ?>" class="btn btn-default">Cancel</a>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</section>
<?php   load_module_asset('member', 'js'); ?>