<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section class="content-header">
    <h1> Expense  <small><?php echo $button ?></small> <a href="<?php echo site_url(Backend_URL . 'expense') ?>" class="btn btn-default">Back</a> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="<?php echo Backend_URL ?>expense">Expense</a></li>
        <li class="active">Add New</li>
    </ol>
</section>

<section class="content">  


    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Add New Expense</h3>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-md-6 col-md-offset-1">
                    <div id="submit_respond"></div>
                 <form action="<?= $action; ?>" id="new_expense" onsubmit="return save_expense(event);" class="form-horizontal" method="post" accept-charset="utf-8">
                    
                    <div class="form-group">
                        <label for="trans_date" class="col-sm-3 control-label">Trans Date :</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control js_datepicker" autocomplete="off" name="trans_date" id="trans_date" placeholder="Paid Date" value="<?php echo $trans_date; ?>" />
                            </div>                    
                            <?php echo form_error('trans_date') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="head_id" class="col-sm-3 control-label">Select Head :</label>
                        <div class="col-sm-9">                    
                            <select class="form-control" name="head_id" id="head_id">
                                <?php echo Helper::getDropDownHead('Expense', 'Head', $head_id); ?>
                            </select>
                            <?php echo form_error('head_id') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sub_head_id" class="col-sm-3 control-label">Select Sub Head :</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="sub_head_id" id="sub_head_id">
                                <?php echo Helper::getDropDownHead('Expense', 'SubHead', $sub_head_id); ?>
                            </select>                    
                            <?php echo form_error('sub_head_id') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="amount" class="col-sm-3 control-label">Amount :</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                                <input type="number" autocomplete="off" class="form-control" name="amount" id="amount" placeholder="Taka" value="<?php echo $amount; ?>" />
                                <span class="input-group-addon">TK</span>
                            </div>                    
                            <?php echo form_error('amount') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="remark" class="col-sm-3 control-label">Remark :</label>
                        <div class="col-sm-9">                    
                            <input type="text" class="form-control" name="remark" id="remark" placeholder="Remark" value="<?php echo $remark; ?>" />
                            <?php echo form_error('remark') ?>
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">                        
                            <button type="submit" class="btn btn-primary">Save</button> 
                            <a href="<?php echo site_url( Backend_URL . 'expense') ?>" class="btn btn-default">Cancel</a>
                        </div>
                    </div>
                 </form>
                
                </div>
            </div>
        </div>
    </div>
</section>

<script>

    function save_expense( e ) {
        e.preventDefault();

        var FormData = $('#new_expense').serialize();
        var error = 0;

        var head_id = parseInt(jQuery('#head_id').val()) || 0;
        if (head_id === 0) {
            jQuery('#head_id').addClass('required');
            error = 1;
        } else {
            jQuery('#head_id').addClass('required_pass');
        }
        
        var sub_head_id = parseInt(jQuery('#sub_head_id').val()) || 0;
        if (sub_head_id === 0) {
            jQuery('#sub_head_id').addClass('required');
            error = 1;
        } else {
            jQuery('#sub_head_id').addClass('required_pass');
        }

        var tk = parseInt(jQuery('#amount').val()) || 0;
        if (tk === 0) {
            jQuery('#amount').addClass('required');
            error = 1;
        } else {
            jQuery('#amount').addClass('required_pass');
        }

        if (!error) {
            jQuery.ajax({
                url: 'trans/ajax/save_expense',
                type: "POST",
                dataType: "json",
                data: FormData,
                beforeSend: function () {
                    jQuery('#submit_respond')
                            .html('<p class="ajax_processing">Please Wait....</p>')
                            .css('display', 'block');
                },
                success: function (jsonRespond) {
                    jQuery('#submit_respond').html(jsonRespond.Msg);

                    if (jsonRespond.Status === 'OK') {
                        jQuery("#new_expense")[0].reset();
                        setTimeout(function () {
                            jQuery('#submit_respond').slideUp('slow');
                            jQuery('#action_btn').show();
                        }, 2000);
                    }
                }
            });
        }

    }


    jQuery(function () {
        jQuery(document).on('click', 'input[type=number]', function () {
            this.select();
        });
    });

</script>