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

<section class="content"><?php echo memberTabs($id, 'update'); ?><div class="box no-border">
<div class="box-header with-border">
            <h3 class="box-title">Update Member</h3>
            <?php echo $this->session->flashdata('message'); ?>
        </div>
        
        <div class="box-body">
        <form class="form-horizontal" action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
                    <label for="union_id" class="col-sm-2 control-label">Union Id :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="union_id" id="union_id" placeholder="Union Id" value="<?php echo $union_id; ?>" />
                        <?php echo form_error('union_id') ?>
                    </div>
                </div>
	    <div class="form-group">
                    <label for="previous_holding_no" class="col-sm-2 control-label">Previous Holding No :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="previous_holding_no" id="previous_holding_no" placeholder="Previous Holding No" value="<?php echo $previous_holding_no; ?>" />
                        <?php echo form_error('previous_holding_no') ?>
                    </div>
                </div>
	    <div class="form-group">
                    <label for="present_holding_no" class="col-sm-2 control-label">Present Holding No :</label>
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
                    <label for="date_of_birth" class="col-sm-2 control-label">Date Of Birth :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="date_of_birth" id="date_of_birth" placeholder="Date Of Birth" value="<?php echo $date_of_birth; ?>" />
                        <?php echo form_error('date_of_birth') ?>
                    </div>
                </div>
	    <div class="form-group">
                    <label for="social_security_benefit_id" class="col-sm-2 control-label">Social Security Benefit Id :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="social_security_benefit_id" id="social_security_benefit_id" placeholder="Social Security Benefit Id" value="<?php echo $social_security_benefit_id; ?>" />
                        <?php echo form_error('social_security_benefit_id') ?>
                    </div>
                </div>
	    <div class="form-group">
                    <label for="income_source_id" class="col-sm-2 control-label">Income Source Id :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="income_source_id" id="income_source_id" placeholder="Income Source Id" value="<?php echo $income_source_id; ?>" />
                        <?php echo form_error('income_source_id') ?>
                    </div>
                </div>
	    <div class="form-group">
                    <label for="house_members" class="col-sm-2 control-label">House Members :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="house_members" id="house_members" placeholder="House Members" value="<?php echo $house_members; ?>" />
                        <?php echo form_error('house_members') ?>
                    </div>
                </div>
	    <div class="form-group">
                    <label for="male" class="col-sm-2 control-label">Male :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="male" id="male" placeholder="Male" value="<?php echo $male; ?>" />
                        <?php echo form_error('male') ?>
                    </div>
                </div>
	    <div class="form-group">
                    <label for="female" class="col-sm-2 control-label">Female :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="female" id="female" placeholder="Female" value="<?php echo $female; ?>" />
                        <?php echo form_error('female') ?>
                    </div>
                </div>
	    <div class="form-group">
                    <label for="adult" class="col-sm-2 control-label">Adult :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="adult" id="adult" placeholder="Adult" value="<?php echo $adult; ?>" />
                        <?php echo form_error('adult') ?>
                    </div>
                </div>
	    <div class="form-group">
                    <label for="infant" class="col-sm-2 control-label">Infant :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="infant" id="infant" placeholder="Infant" value="<?php echo $infant; ?>" />
                        <?php echo form_error('infant') ?>
                    </div>
                </div>
	    <div class="form-group">
                    <label for="tube_well" class="col-sm-2 control-label">Tube Well :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="tube_well" id="tube_well" placeholder="Tube Well" value="<?php echo $tube_well; ?>" />
                        <?php echo form_error('tube_well') ?>
                    </div>
                </div>
	    <div class="form-group">
                    <label for="latrine" class="col-sm-2 control-label">Latrine :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="latrine" id="latrine" placeholder="Latrine" value="<?php echo $latrine; ?>" />
                        <?php echo form_error('latrine') ?>
                    </div>
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
                        <input type="text" class="form-control" name="disabled_member_age" id="disabled_member_age" placeholder="Disabled Member Age" value="<?php echo $disabled_member_age; ?>" />
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
                    <label for="asset_type_id" class="col-sm-2 control-label">Asset Type Id :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="asset_type_id" id="asset_type_id" placeholder="Asset Type Id" value="<?php echo $asset_type_id; ?>" />
                        <?php echo form_error('asset_type_id') ?>
                    </div>
                </div>
	    <div class="form-group">        
                    <label for="description" class="col-sm-2 control-label">Description :</label>
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
                    <label for="type_of_infrastructure" class="col-sm-2 control-label">Type Of Infrastructure :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="type_of_infrastructure" id="type_of_infrastructure" placeholder="Type Of Infrastructure" value="<?php echo $type_of_infrastructure; ?>" />
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
	    <div class="form-group">
                    <label for="created_by" class="col-sm-2 control-label">Created By :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="created_by" id="created_by" placeholder="Created By" value="<?php echo $created_by; ?>" />
                        <?php echo form_error('created_by') ?>
                    </div>
                </div>
	    <div class="form-group">
                    <label for="updated_by" class="col-sm-2 control-label">Updated By :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="updated_by" id="updated_by" placeholder="Updated By" value="<?php echo $updated_by; ?>" />
                        <?php echo form_error('updated_by') ?>
                    </div>
                </div>
	    <div class="form-group">
                    <label for="created_at" class="col-sm-2 control-label">Created At :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="created_at" id="created_at" placeholder="Created At" value="<?php echo $created_at; ?>" />
                        <?php echo form_error('created_at') ?>
                    </div>
                </div>
	    <div class="form-group">
                    <label for="updated_at" class="col-sm-2 control-label">Updated At :</label>
                    <div class="col-sm-10">                    
                        <input type="text" class="form-control" name="updated_at" id="updated_at" placeholder="Updated At" value="<?php echo $updated_at; ?>" />
                        <?php echo form_error('updated_at') ?>
                    </div>
                </div>
	<div class="col-md-12 text-right">
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url( Backend_URL .'member') ?>" class="btn btn-default">Cancel</a>
	</div>
</form>
	</div>
</div>
</section>