<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php load_module_asset('user', 'css'); ?>
<section class="content-header">
    <h1>Template<small><?php echo $button ?></small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="<?php echo Backend_URL ?>sms">Sms</a></li>
        <li><a href="<?php echo Backend_URL ?>sms/template">Template</a></li>
        <li class="active">Update</li>
    </ol>
</section>

<section class="content">    
    <div class="box no-border">
        <div class="box-header with-border">
            <h3 class="box-title">Update Template</h3>
            <?php echo $this->session->flashdata('message'); ?>
        </div>

        <div class="box-body">
            <form class="form-horizontal" action="<?php echo $action; ?>" method="post">
                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Title :</label>
                    <div class="col-sm-6">                    
                        <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="<?php echo $title; ?>" />
                        <?php echo form_error('title') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="body" class="col-sm-2 control-label">Body :</label>
                    <div class="col-sm-6">                    
                        <textarea rows="5" class="form-control" name="body" id="body"><?php echo $body; ?></textarea>                        
                        <p class="help-block text-red"><em>English Letter Limit <b>160</b>. Write: <b id="write_en">0</b> Left: <b id="limit_en">0</b>.</em></p>
                        <p class="help-block text-red"><em>Bangla Letter Limit <b>70</b>. Write: <b id="write_bn">0</b> Left: <b id="limit_bn">0</b>.</em></p>
                        <p class="help-block text-red"><em>[{PaidTK} + {DueTK} = 15 Charters. But may count as 4~6 Charters</b> e.g. Paid 200/1500 & Due 0/200/1500 etc</p>
                        <?php echo form_error('body') ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-2"></div>
                    <div class="col-md-2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                        <a href="<?php echo site_url(Backend_URL . 'sms/template') ?>" class="btn btn-default">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<?php load_module_asset('sms','js');?>