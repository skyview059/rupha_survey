<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php load_module_asset('users','css'); ?>
<section class="content-header">
    <h1>Member  <small>Read</small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url( Backend_URL )?>"><i class="fa fa-dashboard"></i> Admin</a></li>
	<li><a href="<?php echo site_url( Backend_URL .'member' )?>">Member</a></li>
        <li class="active">Details</li>
    </ol>
</section>

<section class="content">
    <?php echo memberTabs($id, 'read'); ?>
    <div class="box no-border">
        
        <div class="box-header with-border">
            <h3 class="box-title">Details View</h3>
            <?php echo $this->session->flashdata('message'); ?>
        </div>
        <table class="table table-striped">
	    <tr><td width="150">Union Id</td><td width="5">:</td><td><?php echo $union_id; ?></td></tr>
	    <tr><td width="150">Previous Holding No</td><td width="5">:</td><td><?php echo $previous_holding_no; ?></td></tr>
	    <tr><td width="150">Present Holding No</td><td width="5">:</td><td><?php echo $present_holding_no; ?></td></tr>
	    <tr><td width="150">Word No</td><td width="5">:</td><td><?php echo $word_no; ?></td></tr>
	    <tr><td width="150">Village</td><td width="5">:</td><td><?php echo $village; ?></td></tr>
	    <tr><td width="150">Khana Chief Name Ba</td><td width="5">:</td><td><?php echo $khana_chief_name_ba; ?></td></tr>
	    <tr><td width="150">Khana Chief Name En</td><td width="5">:</td><td><?php echo $khana_chief_name_en; ?></td></tr>
	    <tr><td width="150">Mobile No</td><td width="5">:</td><td><?php echo $mobile_no; ?></td></tr>
	    <tr><td width="150">Avg Annual Income</td><td width="5">:</td><td><?php echo $avg_annual_income; ?></td></tr>
	    <tr><td width="150">Father Name</td><td width="5">:</td><td><?php echo $father_name; ?></td></tr>
	    <tr><td width="150">Mother Name</td><td width="5">:</td><td><?php echo $mother_name; ?></td></tr>
	    <tr><td width="150">Date Of Birth</td><td width="5">:</td><td><?php echo $date_of_birth; ?></td></tr>
	    <tr><td width="150">Social Security Benefit Id</td><td width="5">:</td><td><?php echo $social_security_benefit_id; ?></td></tr>
	    <tr><td width="150">Income Source Id</td><td width="5">:</td><td><?php echo $income_source_id; ?></td></tr>
	    <tr><td width="150">House Members</td><td width="5">:</td><td><?php echo $house_members; ?></td></tr>
	    <tr><td width="150">Male</td><td width="5">:</td><td><?php echo $male; ?></td></tr>
	    <tr><td width="150">Female</td><td width="5">:</td><td><?php echo $female; ?></td></tr>
	    <tr><td width="150">Adult</td><td width="5">:</td><td><?php echo $adult; ?></td></tr>
	    <tr><td width="150">Infant</td><td width="5">:</td><td><?php echo $infant; ?></td></tr>
	    <tr><td width="150">Tube Well</td><td width="5">:</td><td><?php echo $tube_well; ?></td></tr>
	    <tr><td width="150">Latrine</td><td width="5">:</td><td><?php echo $latrine; ?></td></tr>
	    <tr><td width="150">Disabled Member Name</td><td width="5">:</td><td><?php echo $disabled_member_name; ?></td></tr>
	    <tr><td width="150">Disabled Member Age</td><td width="5">:</td><td><?php echo $disabled_member_age; ?></td></tr>
	    <tr><td width="150">Type Of Disability</td><td width="5">:</td><td><?php echo $type_of_disability; ?></td></tr>
	    <tr><td width="150">Expatriate Name</td><td width="5">:</td><td><?php echo $expatriate_name; ?></td></tr>
	    <tr><td width="150">Country Name</td><td width="5">:</td><td><?php echo $country_name; ?></td></tr>
	    <tr><td width="150">Asset Type Id</td><td width="5">:</td><td><?php echo $asset_type_id; ?></td></tr>
	    <tr><td width="150">Description</td><td width="5">:</td><td><?php echo $description; ?></td></tr>
	    <tr><td width="150">Raw House</td><td width="5">:</td><td><?php echo $raw_house; ?></td></tr>
	    <tr><td width="150">Half Baked House</td><td width="5">:</td><td><?php echo $half_baked_house; ?></td></tr>
	    <tr><td width="150">Paved House</td><td width="5">:</td><td><?php echo $paved_house; ?></td></tr>
	    <tr><td width="150">Type Of Infrastructure</td><td width="5">:</td><td><?php echo $type_of_infrastructure; ?></td></tr>
	    <tr><td width="150">Annual Value</td><td width="5">:</td><td><?php echo $annual_value; ?></td></tr>
	    <tr><td width="150">Annual Tax Amount</td><td width="5">:</td><td><?php echo $annual_tax_amount; ?></td></tr>
	    <tr><td width="150">Created By</td><td width="5">:</td><td><?php echo $created_by; ?></td></tr>
	    <tr><td width="150">Updated By</td><td width="5">:</td><td><?php echo $updated_by; ?></td></tr>
	    <tr><td width="150">Created At</td><td width="5">:</td><td><?php echo $created_at; ?></td></tr>
	    <tr><td width="150">Updated At</td><td width="5">:</td><td><?php echo $updated_at; ?></td></tr>
	    <tr><td></td><td></td><td><a href="<?php echo site_url( Backend_URL .'member') ?>" class="btn btn-default"><i class="fa fa-long-arrow-left"></i> Back</a><a href="<?php echo site_url( Backend_URL .'member/update/'.$id ) ?>" class="btn btn-primary"> <i class="fa fa-edit"></i> Edit</a></td></tr>
	</table>
	</div></section>