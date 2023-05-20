<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<section class="content-header">
    <h1> Member  <small><?php echo $button ?></small> <a href="<?php echo site_url(Backend_URL . 'member') ?>" class="btn btn-default">Back</a> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="<?php echo Backend_URL ?>member">Member</a></li>
        <li class="active">Add New</li>
    </ol>
</section>

<section class="content">
    <?php echo $this->session->flashdata('message'); ?>
    <?php echo $access_msg; ?>
    <div id="ajax_respond"></div>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">নতুন সদস্য যোগ করুন</h3>
        </div>
        
        <div class="box-body">
            <form class="form-horizontal" id="memberForm" name="memberForm" method="post"> 
                <div class="form-group">
                    <label for="union_id" class="col-sm-2 control-label">ইউনিয়ন :<sup>*</sup></label>
                    <div class="col-sm-10">                        
                        <select id="union_id" name="union_id" class="form-control">
                            <?php echo getUnions($union_id, $upazilla_id); ?>
                        </select>
                        <?php echo form_error('union_id') ?>
                        
                        <?php /* if(in_array($role_id,[3,4])){?>
                            <input type="text" value="<?= $union_bn_name?>" class="form-control" readonly >
                            <input type="hidden" name="union_id" id="union_id" value="<?= $union_id?>">
                        <?php }else{?>
                            <select id="union_id" name="union_id" class="form-control">
                                <?php echo getUnions($union_id, $upazilla_id); ?>
                            </select>
                        <?php } */ ?>
                        
                    </div>
                </div>
                <div class="form-group">
                    <label for="present_holding_no" class="col-sm-2 control-label">হোল্ডিং নাম্বার :<sup>*</sup></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="present_holding_no" id="present_holding_no" placeholder="বর্তমান হোল্ডিং নম্বর" value="<?php echo $present_holding_no; ?>" />
                        <?php echo form_error('present_holding_no') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="khana_chief_name_ba" class="col-sm-2 control-label">খানা প্রধানের নাম (বাংলায়):<sup>*</sup></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="khana_chief_name_ba" id="khana_chief_name_ba" placeholder="খানা প্রধানের নাম (বাংলায়)" value="<?php echo $khana_chief_name_ba; ?>" />
                        <?php echo form_error('khana_chief_name_ba') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="khana_chief_name_en" class="col-sm-2 control-label">খানা প্রধানের নাম (ইংরেজিতে) :<sup>*</sup></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="khana_chief_name_en" id="khana_chief_name_en" placeholder="খানা প্রধানের নাম (ইংরেজিতে)" value="<?php echo $khana_chief_name_en; ?>" />
                        <?php echo form_error('khana_chief_name_en') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="father_name" class="col-sm-2 control-label">পিতা/স্বামীর নাম :<sup>*</sup></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="father_name" id="father_name" placeholder="পিতা/স্বামীর নাম" value="<?php echo $father_name; ?>" />
                        <?php echo form_error('father_name') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="mother_name" class="col-sm-2 control-label">মাতার নাম :<sup>*</sup></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="mother_name" id="mother_name" placeholder="মাতার নাম" value="<?php echo $mother_name; ?>" />
                        <?php echo form_error('mother_name') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="date_of_birth" class="col-sm-2 control-label">জন্ম তারিখ :<sup>*</sup></label>
                    <div class="col-sm-5">
                        <div class="input-group">
                            <!--<span class="input-group-addon"><i class="fa fa-calendar"></i></span>-->
                            <!--<input type="text" name="date_of_birth" id="date_of_birth" placeholder="জন্ম তারিখ" value="<?php echo $date_of_birth; ?>" class="form-control js_datepicker" readonly="readonly"/>-->
                            
                            <span class="input-group-addon">Day/</span>
                            <input type="text" name="dob[dd]" placeholder="DD" class="form-control" maxlength="2"/>
                            <span class="input-group-addon">Month/</span>
                            <input type="text" name="dob[mm]" placeholder="MM" class="form-control" maxlength="2"/>
                            <span class="input-group-addon">Year/</span>
                            <input type="text" name="dob[yy]" placeholder="YYYY" class="form-control" maxlength="4"/>
                        </div>
                        <?php echo form_error('date_of_birth') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nid" class="col-sm-2 control-label">জাতীয় পরিচয়পত্র/জন্ম নিবন্ধন নং:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nid" id="nid" placeholder="জাতীয় পরিচয়পত্র/জন্ম নিবন্ধন নং" value="<?php echo $nid; ?>" />
                        <?php echo form_error('nid') ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="profession" class="col-sm-2 control-label">পেশা:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="profession" id="profession" placeholder="পেশা" value="<?php echo $profession; ?>" />
                        <?php echo form_error('profession') ?>
                    </div>
                </div>
                
                
                <div class="form-group">
                    <label for="village" class="col-sm-2 control-label">গ্রাম/মহল্লার নাম :<sup>*</sup></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="village" id="village" placeholder="গ্রাম/মহল্লার নাম" value="<?php echo $village; ?>" />
                        <?php echo form_error('village') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="word_no" class="col-sm-2 control-label">ওয়ার্ড নং :<sup>*</sup></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="word_no" id="word_no" placeholder="ওয়ার্ড নং" value="<?php echo $word_no; ?>" />
                        <?php echo form_error('word_no') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="mobile_no" class="col-sm-2 control-label">মোবাইল নং :<sup>*</sup></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="mobile_no" id="mobile_no" placeholder="মোবাইল নং" value="<?php echo $mobile_no; ?>" />
                        <?php echo form_error('mobile_no') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="house_members" class="col-sm-2 control-label">পরিবারের সদস্য সংখ্যা :</label>
                    <div class="col-sm-10">
                        <input type="number" min="0" step="1" class="form-control" name="house_members" id="house_members" placeholder="খানা সদস্য সংখ্যা" value="<?php echo $house_members; ?>" />
                        <?php echo form_error('house_members') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="social_security_benefit_id" class="col-sm-2 control-label">সামাজিক সুরক্ষার সুবিধা:<sup>*</sup></label>
                    <div class="col-sm-10">
                        <select id="social_security_benefit_id" name="social_security_benefit_id" class="form-control">
                            <?php echo getSocialSecurityBenefit($social_security_benefit_id); ?>
                        </select>
                        <?php echo form_error('social_security_benefit_id') ?>
                    </div>
                </div>
                
               

                <h3>বসতঘর/অবকাঠামোর ধরণ</h3>
                <div class="form-group">
                    <label for="raw_house" class="col-sm-2 control-label">কাঁচা ঘর :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="raw_house" id="raw_house" placeholder="কাঁচা ঘর" value="<?php echo $raw_house; ?>" />
                        <?php echo form_error('raw_house') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="half_baked_house" class="col-sm-2 control-label">আধাপাকা ঘর :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="half_baked_house" id="half_baked_house" placeholder="আধাপাকা ঘর" value="<?php echo $half_baked_house; ?>" />
                        <?php echo form_error('half_baked_house') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="paved_house" class="col-sm-2 control-label">পাকা ঘর :</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="paved_house" id="paved_house" placeholder="পাকা ঘর" value="<?php echo $paved_house; ?>" />
                        <?php echo form_error('paved_house') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="type_of_infrastructure" class="col-sm-2 control-label">ধরন :</label>
                    <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type_of_infrastructure" id="type_of_infrastructure_yes" value="নিজে বসবাস">
                                <label class="form-check-label" for="type_of_infrastructure_yes">নিজে বসবাস</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type_of_infrastructure" id="type_of_infrastructure_no" value="ভাড়া নেওয়া">
                                <label class="form-check-label" for="type_of_infrastructure_no">ভাড়া নেওয়া</label>
                            </div>
                        <?php echo form_error('type_of_infrastructure') ?>
                    </div>
                </div>
                
                <h3>বাৎসরিক কর নির্ণয় : </h3>
                <div class="table-responsive">
                    <table id="annualTaxAssessmentTable" class="table table-bordered table-hover mb-4">
                        <thead>
                            <tr>
                                <th width="20%" class="text-center">অর্থবছর</th>
                                <th width="20%" class="text-center">বাৎসরিক ধার্যকৃত কর</th>
                                <th width="10%" class="text-center">বর্তমান জমা টাকা</th>
                                <th width="10%" class="text-center">চলমান বকেয়া টাকা</th>
                                <th width="20%" class="text-center">পূর্ববর্তী অর্থবছরের বকেয়া টাকা</th>
                                <th width="10%" class="text-center">পূর্ববর্তী অর্থবছরের সাল</th>
                                <th width="10%" class="text-center">মোট বকেয়া টাকা</th>
                                <th width="10%" class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr data-id="0" id="annual_tax_assessment_item-0" class="annual-tax-assessment-item">
                                <td class="text-center">
                                    <input type="text" class="form-control" id="fiscal_year_0" name="fiscal_year[0]">
                                </td>
                                <td class="text-center">
                                    <input type="number" min="0" class="form-control" id="annual_tax_amount_0" name="annual_tax_amount[0]">
                                </td>
                                <td class="text-center">
                                    <input type="number" min="0" class="form-control" id="current_deposit_amount_0" name="current_deposit_amount[0]">
                                </td>
                                <td class="text-center">
                                    <input type="number" min="0" class="form-control" id="current_due_amount_0" name="current_due_amount[0]">
                                </td>
                                <td class="text-center">
                                    <input type="number" min="0" class="form-control" id="previous_fiscal_year_due_amount_0" name="previous_fiscal_year_due_amount[0]">
                                </td>
                                <td class="text-center">
                                    <input type="text" class="form-control" id="previous_fiscal_year_0" name="previous_fiscal_year[0]">
                                </td>
                                <td class="text-right">
                                    <input type="number" min="0" class="form-control" id="total_due_amount_0" name="total_due_amount[0]">
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-xs btn-danger annual_tax_assessment-delete" data-id="0"><i class="fa fa-trash" ></i></button>
                                </td>
                            </tr>

                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="8" class="text-right">
                                    <button type="button" id="addAnnualTaxAssessment" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> নতুন যোগ করুন</button>
                                </td>
                            </tr>
                        </tfoot>

                    </table>
                </div>

                <div class="col-md-10 col-md-offset-2" style="padding-left:5px;">
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <button id="saveMember" type="button" class="btn btn-primary"><?php echo $button ?></button>
                    <a href="<?php echo site_url(Backend_URL . 'member') ?>" class="btn btn-default">Cancel</a>
                </div>
            </form>
        </div>
        
    </div>
</section>
<script type="text/javascript">
  $(document.body).on('click', '#addAnnualTaxAssessment' ,function(event){

    var index = Date.now();

    let markup = '<tr data-id="'+index+'" class="annual-tax-assessment-item" id="annual_tax_assessment_item-'+index+'">' +
    '<td>' +
    '<input type="text" class="form-control" id="fiscal_year-'+index+'" name="fiscal_year['+index+']">' +
    '</td>' +
    '<td>' +
    '<input type="number" min="0" class="form-control" id="annual_tax_amount-'+index+'" name="annual_tax_amount['+index+']" value="">' +
    '</td>' +
    '<td>' +
    '<input type="number" min="0" class="form-control" id="current_deposit_amount-'+index+'" name="current_deposit_amount['+index+']">' +
    '</td>' +
    '<td class="text-right">' +
    '<input type="number" min="0" class="form-control" id="current_due_amount-'+index+'" name="current_due_amount['+index+']" value="">' +
    '</td>' +
    '<td class="text-right">' +
    '<input type="number" min="0" class="form-control" id="previous_fiscal_year_due_amount-'+index+'" name="previous_fiscal_year_due_amount['+index+']" value="">' +
    '</td>' +
    '<td class="text-right">' +
    '<input type="text" class="form-control" id="previous_fiscal_year-'+index+'" name="previous_fiscal_year['+index+']" value="">' +
    '</td>' +
    '<td class="text-right">' +
    '<input type="number" min="0" class="form-control" id="total_due_amount-'+index+'" name="total_due_amount['+index+']" value="">' +
    '</td>' +
    '<td class="text-center">' +
    '<button class="btn btn-xs btn-danger annual_tax_assessment-delete" data-id="'+index+'"><i class="fa fa-trash" ></i></button>' +
    '</td>' +
    '</tr>';

    $("#annualTaxAssessmentTable tbody").append(markup);

});

$(document.body).on('click', '.annual_tax_assessment-delete' ,function(){
    var id = $(this).attr('data-id');
    $('#annual_tax_assessment_item-'+id).remove();

});

$(document.body).on('click', '#saveMember' ,function(){
    var formData = jQuery('#memberForm').serialize();
    jQuery.ajax({
        url: 'member/create_action',
        type: 'POST',
        dataType: "json",
        data: formData,
        beforeSend: function () {
            jQuery('#ajax_respond').html('<p class="ajax_processing">Loading....</p>');
        },
        success: function (jsonRespond) {
            jQuery('#ajax_respond').html('');
            if(jsonRespond.Status === 'OK'){
                toastr.success('Member Added Successfull', 'Success', {
                    html: true
                });
                // jQuery('#ajax_respond').html( jsonRespond.Msg );
                setTimeout(function() {	
                    jQuery('#ajax_respond').fadeOut(); 
                    location.reload();},
                2000);
            } else {
                toastr.error(jsonRespond.Msg, 'Error', {
                    html: true
                });
                // jQuery('#ajax_respond').html( jsonRespond.Msg );
            }
        }
    });

});


</script>