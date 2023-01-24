<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="content-header">
    <h1> Benefit  <small><?php echo $button ?></small> <a href="<?php echo site_url(Backend_URL . 'benefit') ?>" class="btn btn-default">Back</a> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="<?php echo Backend_URL ?>benefit">Benefit</a></li>
        <li class="active">Add New</li>
    </ol>
</section>

<section class="content">       
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Add New Benefit</h3>
        </div>

        <div class="box-body">
            <?php echo form_open($action, array('class' => 'form-horizontal', 'method' => 'post')); ?>
            <div class="form-group">
                <label for="name_ba" class="col-sm-2 control-label">Name Bangla :</label>
                <div class="col-sm-10">                    
                    <input type="text" class="form-control" name="name_ba" id="name_ba" placeholder="Name Ba" value="<?php echo $name_ba; ?>" />
                    <?php echo form_error('name_ba') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="name_en" class="col-sm-2 control-label">Name English :</label>
                <div class="col-sm-10">                    
                    <input type="text" class="form-control" name="name_en" id="name_en" placeholder="Name En" value="<?php echo $name_en; ?>" />
                    <?php echo form_error('name_en') ?>
                </div>
            </div>
            <div class="form-group">
            <div class="col-md-10 col-md-offset-2">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                <a href="<?php echo site_url(Backend_URL . 'benefit') ?>" class="btn btn-default">Cancel</a>
            </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</section>