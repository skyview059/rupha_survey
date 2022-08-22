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
    <div id="ajax_respond"></div>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Add New Member</h3>
        </div>
        <form class="form-horizontal" id="memberForm" name="memberForm" method="post">
        <div class="box-body">
            
            <div class="form-group">
                <label for="union_id" class="col-sm-2 control-label">ইউনিয়ন :</label>
                <div class="col-sm-10">
                   <select id="union_id" name="union_id" class="form-control">
                    <?php echo getUnions($union_id, 60); ?>
                </select>

                <?php echo form_error('union_id') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="previous_holding_no" class="col-sm-2 control-label">পূর্ববর্তী হোল্ডিং নাম্বার :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="previous_holding_no" id="previous_holding_no" placeholder="Previous Holding No" value="<?php echo $previous_holding_no; ?>" />
                <?php echo form_error('previous_holding_no') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="present_holding_no" class="col-sm-2 control-label">বর্তমান হোল্ডিং নাম্বার :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="present_holding_no" id="present_holding_no" placeholder="Present Holding No" value="<?php echo $present_holding_no; ?>" />
                <?php echo form_error('present_holding_no') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="word_no" class="col-sm-2 control-label">Word No :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="word_no" id="word_no" placeholder="Word No" value="<?php echo $word_no; ?>" />
                <?php echo form_error('word_no') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="village" class="col-sm-2 control-label">Village :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="village" id="village" placeholder="Village" value="<?php echo $village; ?>" />
                <?php echo form_error('village') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="khana_chief_name_ba" class="col-sm-2 control-label">Khana Chief Name Ba :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="khana_chief_name_ba" id="khana_chief_name_ba" placeholder="Khana Chief Name Ba" value="<?php echo $khana_chief_name_ba; ?>" />
                <?php echo form_error('khana_chief_name_ba') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="khana_chief_name_en" class="col-sm-2 control-label">Khana Chief Name En :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="khana_chief_name_en" id="khana_chief_name_en" placeholder="Khana Chief Name En" value="<?php echo $khana_chief_name_en; ?>" />
                <?php echo form_error('khana_chief_name_en') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="mobile_no" class="col-sm-2 control-label">Mobile No :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="mobile_no" id="mobile_no" placeholder="Mobile No" value="<?php echo $mobile_no; ?>" />
                <?php echo form_error('mobile_no') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="avg_annual_income" class="col-sm-2 control-label">Avg Annual Income :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="avg_annual_income" id="avg_annual_income" placeholder="Avg Annual Income" value="<?php echo $avg_annual_income; ?>" />
                <?php echo form_error('avg_annual_income') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="father_name" class="col-sm-2 control-label">Father Name :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="father_name" id="father_name" placeholder="Father Name" value="<?php echo $father_name; ?>" />
                <?php echo form_error('father_name') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="mother_name" class="col-sm-2 control-label">Mother Name :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="mother_name" id="mother_name" placeholder="Mother Name" value="<?php echo $mother_name; ?>" />
                <?php echo form_error('mother_name') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="date_of_birth" class="col-sm-2 control-label">জন্ম তারিখ :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="date_of_birth" id="date_of_birth" placeholder="জন্ম তারিখ" value="<?php echo $date_of_birth; ?>" />
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
            <label for="social_security_benefit_id" class="col-sm-2 control-label">সামাজিক সুরক্ষার সুবিধা:</label>
            <div class="col-sm-10">
                <select id="social_security_benefit_id" name="social_security_benefit_id" class="form-control">
                    <?php echo getSocialSecurityBenefit($social_security_benefit_id); ?>
                </select>
                <?php echo form_error('social_security_benefit_id') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="income_source_id" class="col-sm-2 control-label">খানা প্রদানের পেশা/আয়ের উৎস :</label>
            <div class="col-sm-10">
                <select id="income_source_id" name="income_source_id" class="form-control">
                    <?php echo getIncomeSource($income_source_id); ?>
                </select>
                <?php echo form_error('income_source_id') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="house_members" class="col-sm-2 control-label">খানা সদস্য সংখ্যা :</label>
            <div class="col-sm-10">
                <input type="number" min="0" step="1" class="form-control" name="house_members" id="house_members" placeholder="খানা সদস্য সংখ্যা" value="<?php echo $house_members; ?>" />
                <?php echo form_error('house_members') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="male" class="col-sm-2 control-label">পুরুষ :</label>
            <div class="col-sm-10">
                <input type="number" min="0" step="1" class="form-control" name="male" id="male" placeholder="পুরুষ" value="<?php echo $male; ?>" />
                <?php echo form_error('male') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="female" class="col-sm-2 control-label">মহিলা :</label>
            <div class="col-sm-10">
                <input  type="number" min="0" step="1" class="form-control" name="female" id="female" placeholder="মহিলা" value="<?php echo $female; ?>" />
                <?php echo form_error('female') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="adult" class="col-sm-2 control-label">প্রাপ্ত বয়স্ক :</label>
            <div class="col-sm-10">
                <input type="number" min="0" step="1" class="form-control" name="adult" id="adult" placeholder="প্রাপ্ত বয়স্ক" value="<?php echo $adult; ?>" />
                <?php echo form_error('adult') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="infant" class="col-sm-2 control-label">অপ্রাপ্ত বয়স্ক :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="infant" id="infant" placeholder="অপ্রাপ্ত বয়স্ক" value="<?php echo $infant; ?>" />
                <?php echo form_error('infant') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="tube_well" class="col-sm-2 control-label">নলকূপ :</label>
            <div class="col-sm-10">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tube_well" id="tube_well_yes" value="হাঁ">
                    <label class="form-check-label" for="tube_well_yes">হাঁ</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tube_well" id="tube_well_no" value="না">
                    <label class="form-check-label" for="tube_well_no">না</label>
                </div>
                <?php echo form_error('tube_well') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="latrine" class="col-sm-2 control-label">ল্যাট্রিন :</label>
            <div class="col-sm-10">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="latrine" id="latrine_yes" value="হাঁ">
                    <label class="form-check-label" for="latrine_yes">হাঁ</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="latrine" id="latrine_no" value="না">
                    <label class="form-check-label" for="latrine_no">না</label>
                </div>
                <?php echo form_error('latrine') ?>
            </div>
        </div>
        <h3>খানার অন্যান্য সদস্যের তথ্য :</h3>
        <div class="table-responsive">
            <table id="relativeTable" class="table table-bordered table-hover mb-4">
                <thead>
                    <tr>
                        <th width="20%" class="text-center">নাম</th>
                        <th width="30%" class="text-center">পেশা</th>
                        <th width="20%" class="text-center">সম্পর্ক</th>
                        <th width="20%" class="text-center">শিক্ষাগত যোগ্যতা</th>
                        <th width="10%" class="text-center">ক্রিয়া</th>
                    </tr>
                </thead>
                <tbody>

                    <tr data-id="0" id="relative_item-0" class="relative-item">
                        <td class="text-center">
                            <input type="text" class="form-control" id="relative_name_0" name="relative_name[0]">
                        </td>
                        <td class="text-center">
                            <input type="text" class="form-control" id="relative_occupation_0" name="relative_occupation[0]">
                        </td>
                        <td class="text-center">
                            <input type="text" class="form-control" id="relative_relationship_0" name="relative_relationship[0]">
                        </td>
                        <td class="text-right">
                            <input type="text" class="form-control" id="relative_educational_qualification_0" name="relative_educational_qualification[0]">
                        </td>
                        <td class="text-center">
                            <button class="btn btn-xs btn-danger relative-delete" data-id="0"><i class="fa fa-trash" ></i></button>
                        </td>
                    </tr>

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-right">
                            <button type="button" id="addRelative" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add New</button>
                        </td>
                    </tr>
                </tfoot>

            </table>
        </div>

        <div class="form-group">
            <label for="disabled_member_name" class="col-sm-2 control-label">Disabled Member Name :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="disabled_member_name" id="disabled_member_name" placeholder="Disabled Member Name" value="<?php echo $disabled_member_name; ?>" />
                <?php echo form_error('disabled_member_name') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="disabled_member_age" class="col-sm-2 control-label">Disabled Member Age :</label>
            <div class="col-sm-10">
                <input type="number" min="0" step="any" class="form-control" name="disabled_member_age" id="disabled_member_age" placeholder="Disabled Member Age" value="<?php echo $disabled_member_age; ?>" />
                <?php echo form_error('disabled_member_age') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="type_of_disability" class="col-sm-2 control-label">Type Of Disability :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="type_of_disability" id="type_of_disability" placeholder="Type Of Disability" value="<?php echo $type_of_disability; ?>" />
                <?php echo form_error('type_of_disability') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="expatriate_name" class="col-sm-2 control-label">Expatriate Name :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="expatriate_name" id="expatriate_name" placeholder="Expatriate Name" value="<?php echo $expatriate_name; ?>" />
                <?php echo form_error('expatriate_name') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="country_name" class="col-sm-2 control-label">Country Name :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="country_name" id="country_name" placeholder="Country Name" value="<?php echo $country_name; ?>" />
                <?php echo form_error('country_name') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="asset_type_id" class="col-sm-2 control-label">খানা প্রদানের সম্পদের ধরন :</label>
            <div class="col-sm-10">
               <select id="asset_type_id" name="asset_type_id" class="form-control">
                <?php echo getAssetType($asset_type_id); ?>
            </select>
            <?php echo form_error('asset_type_id') ?>
        </div>
    </div>
    <div class="form-group">
        <label for="description" class="col-sm-2 control-label">বিস্তারিত উল্লেখ করুন :</label>
        <div class="col-sm-10">
            <textarea class="form-control" rows="3" name="description" id="description" placeholder="Description"><?php echo $description; ?></textarea>
            <?php echo form_error('description') ?>
        </div>
    </div>
    <div class="form-group">
        <label for="raw_house" class="col-sm-2 control-label">Raw House :</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="raw_house" id="raw_house" placeholder="Raw House" value="<?php echo $raw_house; ?>" />
            <?php echo form_error('raw_house') ?>
        </div>
    </div>
    <div class="form-group">
        <label for="half_baked_house" class="col-sm-2 control-label">Half Baked House :</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="half_baked_house" id="half_baked_house" placeholder="Half Baked House" value="<?php echo $half_baked_house; ?>" />
            <?php echo form_error('half_baked_house') ?>
        </div>
    </div>
    <div class="form-group">
        <label for="paved_house" class="col-sm-2 control-label">Paved House :</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="paved_house" id="paved_house" placeholder="Paved House" value="<?php echo $paved_house; ?>" />
            <?php echo form_error('paved_house') ?>
        </div>
    </div>
    <div class="form-group">
        <label for="type_of_infrastructure" class="col-sm-2 control-label">বসতঘর অবকাঠামোর ধরন :</label>
        <div class="col-sm-10">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="type_of_infrastructure" id="type_of_infrastructure_yes" value="নিজে বসবাস">
                    <label class="form-check-label" for="type_of_infrastructure_yes">নিজে বসবাস</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="type_of_infrastructure" id="type_of_infrastructure_no" value="ভাড়া দেওয়া">
                    <label class="form-check-label" for="type_of_infrastructure_no">ভাড়া দেওয়া</label>
                </div>
            <?php echo form_error('type_of_infrastructure') ?>
        </div>
    </div>
    <div class="form-group">
        <label for="annual_value" class="col-sm-2 control-label">Annual Value :</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="annual_value" id="annual_value" placeholder="Annual Value" value="<?php echo $annual_value; ?>" />
            <?php echo form_error('annual_value') ?>
        </div>
    </div>
    <div class="form-group">
        <label for="annual_tax_amount" class="col-sm-2 control-label">Annual Tax Amount :</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="annual_tax_amount" id="annual_tax_amount" placeholder="Annual Tax Amount" value="<?php echo $annual_tax_amount; ?>" />
            <?php echo form_error('annual_tax_amount') ?>
        </div>
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
  $(document.body).on('click', '#addRelative' ,function(event){

    var index = Date.now();

    let markup = '<tr data-id="'+index+'" class="relative-item" id="relative_item-'+index+'">' +
    '<td>' +
    '<input type="text" class="form-control" id="relative_name-'+index+'" name="relative_name['+index+']">' +
    '</td>' +
    '<td>' +
    '<input type="text" class="form-control" id="relative_occupation-'+index+'" name="relative_occupation['+index+']" value="">' +
    '</td>' +
    '<td>' +
    '<input type="text" class="form-control" id="relative_relationship-'+index+'" name="relative_relationship['+index+']">' +
    '</td>' +
    '<td class="text-right">' +
    '<input type="text" class="form-control" id="relative_educational_qualification-'+index+'" name="relative_educational_qualification['+index+']" value="">' +
    '</td>' +
    '<td class="text-center">' +
    '<button class="btn btn-xs btn-danger relative-delete" data-id="'+index+'"><i class="fa fa-trash" ></i></button>' +
    '</td>' +
    '</tr>';

    $("#relativeTable tbody").append(markup);

});

$(document.body).on('click', '.relative-delete' ,function(){
    var id = $(this).attr('data-id');
    $('#relative_item-'+id).remove();

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
            if(jsonRepond.Status === 'OK'){
                jQuery('#ajax_respond').html( jsonRepond.Msg );
                setTimeout(function() {	
                    jQuery('#ajax_respond').fadeOut(); 
                    location.reload();},
                2000);
            } else {
                jQuery('#ajax_respond').html( jsonRepond.Msg );
            }
        }
    });

});


</script>