<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php load_module_asset('user','css'); ?>
<style>
    
    .input-group { width: 100%;}
    .input-group-addon {
        width: 120px;
        text-align: right;        
    }
</style>    
<section class="content-header">
    <h1> Bank  <small>Transection Entry</small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="<?php echo Backend_URL ?>bank">Bank</a></li>
        <li class="active">Add New</li>
    </ol>
</section>

<section class="content"> 
    
     
    
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Banking Transaction</h3>
        </div>

        <div class="box-body">
            <?php
            echo form_open('trans/ajax/save_banking', array(
                'class' => 'form-horizontal',
                'method' => 'post',
                'id' => 'new_bank_trans',
                'onSubmit' => 'return newBankTrans(event);',
            ));
            ?>
                <div class="col-md-8 col-md-offset-2">                                    
                    <div class="form-group">                    
                        <?php echo $this->session->flashdata('message'); ?>

                        <div class="input-group">                                                                                     
                            <span class="input-group-addon">তারিখ</span>
                            <input type="text" 
                                   class="form-control js_datepicker" 
                                   name="trans_date"  value="<?php echo date('Y-m-d'); ?>" />     
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>                     
                    </div>

                    <div class="form-group">                    
                        <div class="input-group">                                                                                     
                            <span class="input-group-addon">Select Bank</span>
                            <select class="form-control" name="bank_id" id="bank_id">                                    
                                <?php echo getBankList( $bank_id ); ?>
                            </select>                           
                        </div>                                                                                                    
                    </div>

                    <div class="form-group">
                        <div class="input-group">                                                                                     
                            <span class="input-group-addon">লেনদেনের ধরন</span>
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
                            <div id="success_report"></div>
                        </div>
                    </div>
                    

                    <div class="form-group">                    
                        <div class="input-group">                                                                                     
                            <span class="input-group-addon">নোট</span>
                            <textarea class="form-control" rows="3" name="remark" 
                                      id="note" placeholder="Remark"></textarea>          
                        </div>                    
                    </div>


                    <div class="form-group">
                                               
                        <button id="action_btn" type="submit" class="btn btn-primary">
                            <i class="fa fa-floppy-o"></i> Save Entry
                        </button>                                                                        
                    </div>                    
                </div>
            </form>
        </div>
    </div>    
</section>
<script type="text/javascript">
    
    function newBankTrans(e) {
        e.preventDefault();

        var formData = jQuery('#new_bank_trans').serialize();

        var error = 0;

        var bank_id = parseInt(jQuery('#bank_id').val()) || 0;
        if (bank_id === 0) {
            jQuery('#bank_id').removeClass('required_pass').addClass('required');
            error = 1;
        } else {
            jQuery('#bank_id').removeClass('required').addClass('required_pass');
        }

        var tk = parseInt(jQuery('#amount').val()) || 0;
        if (tk === 0) {
            jQuery('#amount').removeClass('required_pass').addClass('required');
            error = 1;
        } else {
            jQuery('#amount').removeClass('required').addClass('required_pass');
        }

        if (!error) {
            jQuery.ajax({
                url: "trans/ajax/save_banking",
                type: "POST",
                dataType: "json",
                data: formData,
                cache: false,
                beforeSend: function () {
                    jQuery('#success_report')
                            .html('<p class="ajax_processing"> Loading...</p>')
                            .css('display', 'block');
                    jQuery('#action_btn').hide();
                },
                success: function (jsonRespond) {
                    jQuery('#success_report').html(jsonRespond.Msg);
                    if (jsonRespond.Status === 'OK') {
                        jQuery("#new_bank_trans")[0].reset();
                        setTimeout(function () {
                            jQuery('#success_report').slideUp('slow');
                            jQuery('#action_btn').show();
                        }, 2000);
                        
                    }
                }
            });
        }
    }
    </script>