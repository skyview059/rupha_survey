<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1>DPS  <small>Entry</small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="<?php echo Backend_URL ?>bill">Income</a></li>
        <li class="active">Entry</li>
    </ol>
</section>

<section class="content">


    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Income Entry</h3>            
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <form class="form-horizontal" id="collection" action="<?php echo $action; ?>" method="post">
                        <div class="form-group">                    
                            <div class="input-group"> 
                                <?php echo $this->session->flashdata('message'); ?>
                                <div id="submit_respond"></div>
                            </div>
                        </div>
                        <div class="form-group">                    
                            <div class="input-group">
                                <span class="input-group-addon">Trans Date</span>
                                <input type="text" class="form-control js_datepicker" 
                                       name="trans_date" id="trans_date" 
                                       placeholder="Trans Date" readonly="readonly" 
                                       value="<?php echo $trans_date; ?>" /> 
                            </div>                     
                        </div>

                        <div class="form-group">
                            <div class="input-group"> 
                                <span class="input-group-addon">Select Head :</span>

                                <select class="form-control" name="head_id" id="head_id">
                                    <?php echo Helper::getDropDownHead('Income', 'Head', $head_id); ?>
                                </select>
                                <?php echo form_error('head_id') ?>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="input-group"> 
                                <span class="input-group-addon">Select Sub Head :</span>
                            
                                <select class="form-control" name="sub_head_id" id="sub_head_id">
                                    <?php echo Helper::getDropDownHead('Income', 'SubHead', $sub_head_id); ?>
                                </select>                    
                                <?php echo form_error('sub_head_id') ?>
                            </div>
                        </div>

                        <div class="form-group hidden">
                            <div class="input-group">                                                                                     
                                <span class="input-group-addon">Transaction Type</span>
                                <div class="transport_type">                            
                                    <?php echo htmlRadio('tran_type', 'cr', ['cr' => 'জমা', 'dr' => ' উত্তোলন']); ?>                                                                
                                </div>                            
                            </div>
                        </div>

                        <div class="form-group">                    
                            <div class="input-group">                                                                                     
                                <span class="input-group-addon">Amount</span>
                                <input type="number" class="form-control" 
                                       onkeypress="DigitOnly(event);" 
                                       name="amount" id="amount" value="<?php echo $amount; ?>" 
                                       placeholder="Amount" />                      
                            </div>                    
                        </div>

                        <div class="form-group">                    
                            <div class="input-group">                                                                                     
                                <span class="input-group-addon">Remarks</span>
                                <textarea class="form-control" rows="3" name="remark" 
                                          id="remark" placeholder="Remark"></textarea>          
                            </div>                    
                        </div>

                        <div class="form-group">
                            <a href="<?php echo site_url(Backend_URL) ?>" class="btn btn-default">Cancel</a>                            
                            <span id="save_collection" class="btn btn-primary">Save Entry</span>                             
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>


</section>

<script>

    jQuery('#save_collection').on('click', function () {

        var FormData = $('#collection').serialize();
        var error = 0;
        
        var head_id = parseInt(jQuery('#head_id').val()) || 0;
        if (head_id === 0) {
            jQuery('#head_id').addClass('required');
            error = 1;
        } else {
            jQuery('#head_id').addClass('required_pass');
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
                url: 'trans/ajax/save_income',
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
                        jQuery("#collection")[0].reset();
                        setTimeout(function () {
                            jQuery('#submit_respond').slideUp('slow');
                            jQuery('#action_btn').show();
                        }, 2000);
                    }
                }
            });
        }

    });


    jQuery(function () {
        jQuery(document).on('click', 'input[type=number]', function () {
            this.select();
        });
    });

</script>