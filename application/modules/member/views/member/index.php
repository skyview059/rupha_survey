<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1> Member  <small>Control panel</small> <?php echo anchor(site_url( Backend_URL . 'member/create'),' + Add New', 'class="btn btn-default"'); ?> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url( Backend_URL )?>"><i class="fa fa-dashboard"></i> Admin</a></li>
	<li class="active">Member</li>
    </ol>
</section>

<section class="content">       
    <div class="box">            
        <div class="box-header with-border">                                   
            <div class="col-md-3 col-md-offset-9 text-right">
                <form action="<?php echo site_url( Backend_URL .'member'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php if ($q <> '') { ?>
                                <a href="<?php echo site_url( Backend_URL .'member'); ?>" class="btn btn-default">Reset</a>
                            <?php } ?>
                            <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    
        <div class="box-body">
            <?php echo $this->session->flashdata('message'); ?>
            <div class="table-responsive">
            <table class="table table-hover table-condensed">
                <thead>
                    <tr>
                    	<th width="40">S/L</th>
		<th>Union Id</th>
		<th>Previous Holding No</th>
		<th>Present Holding No</th>
		<th>Word No</th>
		<th>Village</th>
		<th>Khana Chief Name Ba</th>
		<th>Khana Chief Name En</th>
		<th>Mobile No</th>
		<th>Avg Annual Income</th>
		<th>Father Name</th>
		<th>Mother Name</th>
		<th>Date Of Birth</th>
		<th>Social Security Benefit Id</th>
		<th>Income Source Id</th>
		<th>House Members</th>
		<th>Male</th>
		<th>Female</th>
		<th>Adult</th>
		<th>Infant</th>
		<th>Tube Well</th>
		<th>Latrine</th>
		<th>Disabled Member Name</th>
		<th>Disabled Member Age</th>
		<th>Type Of Disability</th>
		<th>Expatriate Name</th>
		<th>Country Name</th>
		<th>Asset Type Id</th>
		<th>Description</th>
		<th>Raw House</th>
		<th>Half Baked House</th>
		<th>Paved House</th>
		<th>Type Of Infrastructure</th>
		<th>Annual Value</th>
		<th>Annual Tax Amount</th>
		<th>Created By</th>
		<th>Updated By</th>
		<th>Created At</th>
		<th>Updated At</th>
		<th width="200">Action</th>
                    </tr>
                </thead>

                <tbody>
	<?php foreach ($members as $member) { ?>
                    <tr>
		<td><?php echo ++$start ?></td>
		<td><?php echo $member->union_id; ?></td>
		<td><?php echo $member->previous_holding_no; ?></td>
		<td><?php echo $member->present_holding_no; ?></td>
		<td><?php echo $member->word_no; ?></td>
		<td><?php echo $member->village; ?></td>
		<td><?php echo $member->khana_chief_name_ba; ?></td>
		<td><?php echo $member->khana_chief_name_en; ?></td>
		<td><?php echo $member->mobile_no; ?></td>
		<td><?php echo $member->avg_annual_income; ?></td>
		<td><?php echo $member->father_name; ?></td>
		<td><?php echo $member->mother_name; ?></td>
		<td><?php echo $member->date_of_birth; ?></td>
		<td><?php echo $member->social_security_benefit_id; ?></td>
		<td><?php echo $member->income_source_id; ?></td>
		<td><?php echo $member->house_members; ?></td>
		<td><?php echo $member->male; ?></td>
		<td><?php echo $member->female; ?></td>
		<td><?php echo $member->adult; ?></td>
		<td><?php echo $member->infant; ?></td>
		<td><?php echo $member->tube_well; ?></td>
		<td><?php echo $member->latrine; ?></td>
		<td><?php echo $member->disabled_member_name; ?></td>
		<td><?php echo $member->disabled_member_age; ?></td>
		<td><?php echo $member->type_of_disability; ?></td>
		<td><?php echo $member->expatriate_name; ?></td>
		<td><?php echo $member->country_name; ?></td>
		<td><?php echo $member->asset_type_id; ?></td>
		<td><?php echo $member->description; ?></td>
		<td><?php echo $member->raw_house; ?></td>
		<td><?php echo $member->half_baked_house; ?></td>
		<td><?php echo $member->paved_house; ?></td>
		<td><?php echo $member->type_of_infrastructure; ?></td>
		<td><?php echo $member->annual_value; ?></td>
		<td><?php echo $member->annual_tax_amount; ?></td>
		<td><?php echo $member->created_by; ?></td>
		<td><?php echo $member->updated_by; ?></td>
		<td><?php echo $member->created_at; ?></td>
		<td><?php echo $member->updated_at; ?></td>
		<td>
			<?php 
			echo anchor(site_url(Backend_URL .'member/read/'.$member->id),'<i class="fa fa-fw fa-external-link"></i> View', 'class="btn btn-xs btn-primary"'); 
			echo anchor(site_url(Backend_URL .'member/update/'.$member->id),'<i class="fa fa-fw fa-edit"></i> Edit',  'class="btn btn-xs btn-warning"'); 
			echo anchor(site_url(Backend_URL .'member/delete/'.$member->id),'<i class="fa fa-fw fa-trash"></i> Delete ', 'class="btn btn-xs btn-danger"'); 
			?>
		</td>
                    </tr>
                <?php } ?>
                    </tbody>
                </table>
            </div>
        
        
            <div class="row">                
                <div class="col-md-6">
                    <span class="btn btn-primary">Total Member: <?php echo $total_rows ?></span>
	    
                </div>
                <div class="col-md-6 text-right">
                    <?php echo $pagination ?>
                </div>                
            </div>
        </div>
    </div>
</section>