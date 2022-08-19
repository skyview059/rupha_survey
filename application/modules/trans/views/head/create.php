<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="content-header">
    <h1> Head  <small><?php echo $button ?></small> <a href="<?php echo site_url(Backend_URL . 'expense/head') ?>" class="btn btn-default">Back</a> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="<?php echo Backend_URL ?>expense">Expense</a></li>
        <li><a href="<?php echo Backend_URL ?>expense/head">Head</a></li>
        <li class="active">Add New</li>
    </ol>
</section>

<section class="content">       
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Add New Head</h3>
        </div>

        <div class="box-body">
            <?php echo form_open($action, array('class' => 'form-horizontal', 'method' => 'post')); ?>
            <div class="form-group">
                <label for="type"  class="col-sm-2 control-label">Category :</label>
                <div class="col-sm-10"  style="padding-top:8px;"><?php echo htmlRadio('category', $category, array('Income' => 'Income', 'Expense' => 'Expense')); ?></div>
            </div>
            <div class="form-group">
                <label for="type"  class="col-sm-2 control-label">Type :</label>
                <div class="col-sm-10"  style="padding-top:8px;"><?php echo htmlRadio('type', $type, array('Head' => 'Head', 'SubHead' => 'SubHead')); ?></div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name :</label>
                <div class="col-sm-10">                    
                    <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>" />
                    <?php echo form_error('name') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="status"  class="col-sm-2 control-label">Status :</label>
                <div class="col-sm-10"  style="padding-top:8px;"><?php echo htmlRadio('status', $status, array('Active' => 'Active', 'Inactive' => 'Inactive')); ?></div>
            </div>
            <div class="col-md-10 col-md-offset-2" style="padding-left:5px;">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                <a href="<?php echo site_url(Backend_URL . 'trans/head') ?>" class="btn btn-default">Cancel</a>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</section>