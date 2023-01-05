<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php load_module_asset('users','css'); ?>
<section class="content-header">
    <h1>Member<small><?php echo $button ?></small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
	<li><a href="<?php echo Backend_URL ?>member">Member</a></li>
        <li class="active">Update</li>
    </ol>
</section>

<section class="content"><?php echo memberTabs($id, 'tax'); ?>
    <div class="box no-border">
        <div class="box-header with-border">
            <h3 class="box-title">বাৎসরিক কর নির্ণয়</h3>
            <div id="ajax_respond"></div>
            <?php echo $this->session->flashdata('message'); ?>
        </div>
        
        <div class="box-body">
            <form class="form-horizontal" id="annualTaxAssessmentForm" name="annualTaxAssessmentForm" method="post"> 
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
                            <?php 
                            if($annual_tax_assessments){
                                foreach($annual_tax_assessments as $assessment){
                            ?>
                            <tr data-id="<?= $assessment->id;?>" id="annual_tax_assessment_item-<?= $assessment->id;?>" class="annual-tax-assessment-item">
                                <td class="text-center">
                                    <input type="text" class="form-control" id="fiscal_year_<?= $assessment->id;?>" name="fiscal_year[<?= $assessment->id;?>]" value="<?= $assessment->fiscal_year;?>">
                                </td>
                                <td class="text-center">
                                    <input type="text" class="form-control" id="annual_tax_amount_<?= $assessment->id;?>" name="annual_tax_amount[<?= $assessment->id;?>]" value="<?= $assessment->annual_tax_amount;?>">
                                </td>
                                <td class="text-center">
                                    <input type="text" class="form-control" id="current_deposit_amount_<?= $assessment->id;?>" name="current_deposit_amount[<?= $assessment->id;?>]" value="<?= $assessment->current_deposit_amount;?>">
                                </td>
                                <td class="text-center">
                                    <input type="text" class="form-control" id="current_due_amount_<?= $assessment->id;?>" name="current_due_amount[<?= $assessment->id;?>]" value="<?= $assessment->current_due_amount;?>">
                                </td>
                                <td class="text-right">
                                    <input type="text" class="form-control" id="previous_fiscal_year_due_amount_<?= $assessment->id;?>" name="previous_fiscal_year_due_amount[<?= $assessment->id;?>]" value="<?= $assessment->previous_fiscal_year_due_amount;?>">
                                </td>
                                <td class="text-right">
                                    <input type="text" class="form-control" id="previous_fiscal_year_<?= $assessment->id;?>" name="previous_fiscal_year[<?= $assessment->id;?>]" value="<?= $assessment->previous_fiscal_year;?>">
                                </td>
                                <td class="text-right">
                                    <input type="text" class="form-control" id="total_due_amount_<?= $assessment->id;?>" name="total_due_amount[<?= $assessment->id;?>]" value="<?= $assessment->total_due_amount;?>">
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-xs btn-danger annual_tax_assessment-delete" data-id="<?= $assessment->id;?>"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            <?php 
                                }
                            }else{
                            ?>
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
                            <?php }?>
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
                    <button id="updateAnnualTaxAssessmentForm" type="button" class="btn btn-primary"><?php echo $button ?></button>
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

$(document.body).on('click', '#updateAnnualTaxAssessmentForm' ,function(){
    var formData = jQuery('#annualTaxAssessmentForm').serialize();
    jQuery.ajax({
        url: 'member/update_tax_action',
        type: 'POST',
        dataType: "json",
        data: formData,
        beforeSend: function () {
            jQuery('#ajax_respond').html('<p class="ajax_processing">Loading....</p>');
        },
        success: function (jsonRespond) {
            jQuery('#ajax_respond').html('');
            if(jsonRespond.Status === 'OK'){
                toastr.success('Member Annual Tax Assessment Updated Successlly', 'Success', {
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
                jQuery('#ajax_respond').html( jsonRespond.Msg );
            }
        }
    });

});


</script>