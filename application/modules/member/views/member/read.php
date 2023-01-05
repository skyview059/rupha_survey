<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php load_module_asset('users', 'css'); ?>
<section class="content-header">
    <h1>Member  <small>Read</small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(Backend_URL) ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="<?php echo site_url(Backend_URL . 'member') ?>">Member</a></li>
        <li class="active">Details</li>
    </ol>
</section>

<section class="content">
    <?php echo memberTabs($id, 'read'); ?>
    <div class="box no-border">
		<table class="table table-striped">
			<thead>
				<tr>
					<td class="text-center">
						<h3><?php echo $union_name; ?> ইউনিয়ন পরিষদ</h3>
						<h5>উপজেলা: <?= $upazila_name;?>, <?= $district_name;?></h5>
					</td>
				</tr>
			</thead>
		</table>
        <table class="table table-striped">
			<tr><td width="150">হোল্ডিং নাম্বার</td><td width="5">:</td><td><?php echo $present_holding_no; ?></td></tr>
			<tr><td width="150">খানা প্রধানের নাম (বাংলায়)</td><td width="5">:</td><td><?php echo $khana_chief_name_ba; ?></td></tr>
			<tr><td width="150">খানা প্রধানের নাম (ইংরেজিতে)</td><td width="5">:</td><td><?php echo $khana_chief_name_en; ?></td></tr>
			<tr><td width="150">পিতা/স্বামীর নাম</td><td width="5">:</td><td><?php echo $father_name; ?></td></tr>
			<tr><td width="150">মাতার নাম</td><td width="5">:</td><td><?php echo $mother_name; ?></td></tr>
			<tr><td width="150">জন্ম তারিখ</td><td width="5">:</td><td><?php echo $date_of_birth; ?></td></tr>
			<tr><td width="150">জাতীয় পরিচয়পত্র/জন্ম নিবন্ধন নং</td><td width="5">:</td><td><?php echo $nid; ?></td></tr>
			<tr><td width="150">গ্রাম/মহল্লার নাম</td><td width="5">:</td><td><?php echo $village; ?></td></tr>
			<tr><td width="150">ওয়ার্ড নং</td><td width="5">:</td><td><?php echo $word_no; ?></td></tr>
			<tr><td width="150">মোবাইল নং</td><td width="5">:</td><td><?php echo $mobile_no; ?></td></tr>
			<tr><td width="150">পরিবারের সদস্য সংখ্যা</td><td width="5">:</td><td><?php echo $house_members; ?></td></tr>
			<tr><td width="150">সামাজিক সুরক্ষার সুবিধা</td><td width="5">:</td><td><?php echo $social_security_benefit_name; ?></td></tr>
			<tr>
				<td colspan="4">
					<h3>বসতঘর/অবকাঠামোর ধরণ</h3>
				</td>
			</tr>
			<tr><td width="150">কাঁচা ঘর</td><td width="5">:</td><td><?php echo $raw_house; ?></td></tr>
			<tr><td width="150">আধাপাকা ঘর</td><td width="5">:</td><td><?php echo $half_baked_house; ?></td></tr>
			<tr><td width="150">পাকা ঘর</td><td width="5">:</td><td><?php echo $paved_house; ?></td></tr>
			<tr><td width="150">ধরন</td><td width="5">:</td><td><?php echo $type_of_infrastructure; ?></td></tr>
			<tr>
				<td colspan="4">
					<h3>বাৎসরিক কর নির্ণয়</h3>
				</td>
			</tr>
			<tr>
				<td colspan="4">
					<table id="annualTaxAssessmentTable" class="table table-bordered table-hover mb-4">
                        <thead>
                            <tr>
                                <th width="10%" class="text-center">অর্থবছর</th>
                                <th width="15%" class="text-center">বাৎসরিক ধার্যকৃত কর</th>
                                <th width="15%" class="text-center">বর্তমান জমা টাকা</th>
                                <th width="10%" class="text-center">চলমান বকেয়া টাকা</th>
                                <th width="20%" class="text-center">পূর্ববর্তী অর্থবছরের বকেয়া টাকা</th>
                                <th width="10%" class="text-center">পূর্ববর্তী অর্থবছরের সাল</th>
                                <th width="10%" class="text-center">মোট বকেয়া টাকা</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if($annual_tax_assessments){
                                foreach($annual_tax_assessments as $assessment){
                            ?>
                            <tr>
								<td class="text-center"><?= $assessment->fiscal_year;?></td>
                                <td class="text-right"><?= BDT($assessment->annual_tax_amount);?></td>
                                <td class="text-right"><?= BDT($assessment->current_deposit_amount);?></td>
                                <td class="text-right"><?= BDT($assessment->current_due_amount);?></td>
                                <td class="text-right"><?= BDT($assessment->previous_fiscal_year_due_amount);?></td>
                                <td class="text-center"><?= $assessment->previous_fiscal_year;?></td>
                                <td class="text-right"><?= BDT($assessment->total_due_amount);?></td>
                            </tr>
                            <?php 
                                }
                            }
                            ?>
                        </tbody>
                    </table>
				</td>
			</tr>
			<tr><td width="150">Created By</td><td width="5">:</td><td><?php echo $created_by; ?></td></tr>
			<tr><td width="150">Updated By</td><td width="5">:</td><td><?php echo $updated_by; ?></td></tr>
			<tr><td width="150">Created At</td><td width="5">:</td><td><?php echo $created_at; ?></td></tr>
			<tr><td width="150">Updated At</td><td width="5">:</td><td><?php echo $updated_at; ?></td></tr>
			<tr>
				<td></td>
				<td></td>
				<td>
					<a href="<?php echo site_url( Backend_URL .'member') ?>" class="btn btn-default"><i class="fa fa-long-arrow-left"></i> Back</a><a href="<?php echo site_url( Backend_URL .'member/update/'.$id ) ?>" class="btn btn-primary"> <i class="fa fa-edit"></i> Edit</a>
				</td>
			</tr>
		</table>
	</div>
</section>