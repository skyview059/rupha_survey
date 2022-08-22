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
            <h3 class="box-title">বিস্তারিত দেখুন</h3>
            <?php echo $this->session->flashdata('message'); ?>
        </div>
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
			<tr><td width="150">পূর্ববর্তী হোল্ডিং নাম্বার</td><td width="5">:</td><td><?php echo $previous_holding_no; ?></td></tr>
			<tr><td width="150">বর্তমান হোল্ডিং নাম্বার</td><td width="5">:</td><td><?php echo $present_holding_no; ?></td></tr>
			<tr><td width="150">ওয়ার্ড নং</td><td width="5">:</td><td><?php echo $word_no; ?></td></tr>
			<tr><td width="150">গ্রাম/মহল্লার নাম</td><td width="5">:</td><td><?php echo $village; ?></td></tr>
			<tr><td width="150">খানা প্রধানের নাম (বাংলায়)</td><td width="5">:</td><td><?php echo $khana_chief_name_ba; ?></td></tr>
			<tr><td width="150">খানা প্রধানের নাম (ইংরেজিতে)</td><td width="5">:</td><td><?php echo $khana_chief_name_en; ?></td></tr>
			<tr><td width="150">মোবাইল নং</td><td width="5">:</td><td><?php echo $mobile_no; ?></td></tr>
			<tr><td width="150">বাৎসরিক গড় আয়</td><td width="5">:</td><td><?php echo $avg_annual_income; ?></td></tr>
			<tr><td width="150">পিতা/স্বামীর নাম</td><td width="5">:</td><td><?php echo $father_name; ?></td></tr>
			<tr><td width="150">মাতার নাম</td><td width="5">:</td><td><?php echo $mother_name; ?></td></tr>
			<tr><td width="150">জন্ম তারিখ</td><td width="5">:</td><td><?php echo $date_of_birth; ?></td></tr>
			<tr><td width="150">জাতীয় পরিচয়পত্র/জন্ম নিবন্ধন নং</td><td width="5">:</td><td><?php echo $nid; ?></td></tr>
			<tr><td width="150">সামাজিক সুরক্ষার সুবিধা</td><td width="5">:</td><td><?php echo $social_security_benefit_name; ?></td></tr>
			<tr><td width="150">খানা প্রদানের পেশা/আয়ের উৎস</td><td width="5">:</td><td><?php echo $income_source_name; ?></td></tr>
			<tr><td width="150">খানা সদস্য সংখ্যা</td><td width="5">:</td><td><?php echo $house_members; ?></td></tr>
			<tr><td width="150">পুরুষ</td><td width="5">:</td><td><?php echo $male; ?></td></tr>
			<tr><td width="150">মহিলা</td><td width="5">:</td><td><?php echo $female; ?></td></tr>
			<tr><td width="150">প্রাপ্ত বয়স্ক</td><td width="5">:</td><td><?php echo $adult; ?></td></tr>
			<tr><td width="150">অপ্রাপ্ত বয়স্ক</td><td width="5">:</td><td><?php echo $infant; ?></td></tr>
			<tr><td width="150">নলকূপ</td><td width="5">:</td><td><?php echo $tube_well; ?></td></tr>
			<tr><td width="150">ল্যাট্রিন</td><td width="5">:</td><td><?php echo $latrine; ?></td></tr>
			<tr><td width="150">প্রতিবন্ধী সদস্য থাকলে তার নাম</td><td width="5">:</td><td><?php echo $disabled_member_name; ?></td></tr>
			<tr><td width="150">প্রতিবন্ধী সদস্য থাকলে তার বয়স</td><td width="5">:</td><td><?php echo $disabled_member_age; ?></td></tr>
			<tr><td width="150">প্রতিবন্ধীতার ধরণ</td><td width="5">:</td><td><?php echo $type_of_disability; ?></td></tr>
			<tr><td width="150">প্রবাসী কোন সদস্য থাকলে তার নাম</td><td width="5">:</td><td><?php echo $expatriate_name; ?></td></tr>
			<tr><td width="150">দেশের নাম</td><td width="5">:</td><td><?php echo $country_name; ?></td></tr>
			<tr><td width="150">খানা প্রদানের সম্পদের ধরন</td><td width="5">:</td><td><?php echo $asset_type_name; ?></td></tr>
			<tr><td width="150">বিস্তারিত উল্লেখ করুন</td><td width="5">:</td><td><?php echo $description; ?></td></tr>
			<tr><td width="150">কাঁচা ঘর</td><td width="5">:</td><td><?php echo $raw_house; ?></td></tr>
			<tr><td width="150">আধাপাকা ঘর</td><td width="5">:</td><td><?php echo $half_baked_house; ?></td></tr>
			<tr><td width="150">পাকা ঘর</td><td width="5">:</td><td><?php echo $paved_house; ?></td></tr>
			<tr><td width="150">ধরন</td><td width="5">:</td><td><?php echo $type_of_infrastructure; ?></td></tr>
			<tr><td width="150">বার্ষিক মূল্য/ব্যাংক ঋণ নিয়ে গৃহ তৈরী হলে বার্ষিক সুদ বাদে নীট বার্ষিক মূল্য</td><td width="5">:</td><td><?php echo $annual_value; ?></td></tr>
			<tr><td width="150">বার্ষিক করের পরিমান</td><td width="5">:</td><td><?php echo $annual_tax_amount; ?></td></tr>
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