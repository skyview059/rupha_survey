<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php load_module_asset('users', 'css'); ?>
<?php load_module_asset('member', 'css'); ?>
<link href="assets/custom/print.css" rel="stylesheet" type="text/css"/>
<section class="content-header">
    <h1>Member  <small>Read</small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(Backend_URL) ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="<?php echo site_url(Backend_URL . 'member') ?>">Member</a></li>
        <li class="active">Details</li>
    </ol>
</section>

<section class="content">
    <?php echo memberTabs($id, 'details'); ?>
    <div class="box no-border">
        <div class="box-header text-center">            
            <h3 class="no-margin"><?php echo $union_name; ?> ইউনিয়ন পরিষদ</h3>
            <h5 class="no-margin">উপজেলা: <?= $upazila_name; ?>, জেলা:<?= $district_name; ?></h5>
        </div>
        
        <div class="box-body">
            <fieldset>
                <legend> সাধারণ তথ্য </legend>
                
                <table class="table table-bordered table-striped">
                    <tr><td width="250">হোল্ডিং নাম্বার</td><td width="5">:</td><td><?php echo $present_holding_no; ?></td></tr>
                    <tr><td>খানা প্রধানের নাম (বাংলায়)</td><td>:</td><td><?php echo $khana_chief_name_ba; ?></td></tr>
                    <tr><td>খানা প্রধানের নাম (ইংরেজিতে)</td><td>:</td><td><?php echo $khana_chief_name_en; ?></td></tr>
                    <tr><td>পিতা/স্বামীর নাম</td><td>:</td><td><?php echo $father_name; ?></td></tr>
                    <tr><td>মাতার নাম</td><td>:</td><td><?php echo $mother_name; ?></td></tr>
                    <tr><td>জন্ম তারিখ</td><td>:</td><td><?php echo $date_of_birth; ?></td></tr>
                    <tr><td>জাতীয় পরিচয়পত্র/জন্ম নিবন্ধন নং</td><td>:</td><td><?php echo $nid; ?></td></tr>
                    <tr><td>পেশা</td><td>:</td><td><?php echo $profession; ?></td></tr>
                    <tr><td>গ্রাম/মহল্লার নাম</td><td>:</td><td><?php echo $village; ?></td></tr>
                    <tr><td>ওয়ার্ড নং</td><td>:</td><td><?php echo $word_no; ?></td></tr>
                    <tr><td>মোবাইল নং</td><td>:</td><td><?php echo $mobile_no; ?></td></tr>
                    <tr><td>পরিবারের সদস্য সংখ্যা</td><td>:</td><td><?php echo $house_members; ?></td></tr>
                    <tr><td>সামাজিক সুরক্ষার সুবিধা</td><td>:</td><td><?php echo $social_security_benefit_name; ?></td></tr>                                                            
                </table>
            </fieldset>
            
            
            
            <fieldset>
                <legend> বসতঘর/অবকাঠামোর ধরণ </legend>
                <table class="table table-bordered table-bordered table-striped mb-4">
                    <tr><td width="250">কাঁচা ঘর</td><td width="5">:</td><td><?php echo $raw_house; ?></td></tr>
                    <tr><td>আধাপাকা ঘর</td><td>:</td><td><?php echo $half_baked_house; ?></td></tr>
                    <tr><td>পাকা ঘর</td><td>:</td><td><?php echo $paved_house; ?></td></tr>
                    <tr><td>ধরন</td><td>:</td><td><?php echo $type_of_infrastructure; ?></td></tr>
                    </table>
            </fieldset>
            
            
            <fieldset>
                <legend>বাৎসরিক কর নির্ণয়</legend>
                <?php if ($taxes) { ?>
                    <table class="table table-bordered table-bordered table-striped mb-4">
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
                            <?php foreach ($taxes as $tax) { 
                                
                                $present_due = ($tax->annual_tax_amount - $tax->current_deposit_amount);
                                /* BDT($tax->current_due_amount); */
                                /* $tax->total_due_amount */
                                ?>
                            <tr>
                                <td class="text-center"><?= En2BD_Digit($tax->fiscal_year); ?></td>
                                <td class="text-center"><?= En2BD_Digit(BDT($tax->annual_tax_amount)); ?></td>
                                <td class="text-center"><?= En2BD_Digit(BDT($tax->current_deposit_amount)); ?></td>
                                <td class="text-center"><?php 
                                    // 
                                    echo En2BD_Digit(BDT($present_due));
                                ?></td>
                                <td class="text-center"><?= En2BD_Digit(BDT($tax->previous_fiscal_year_due_amount)); ?></td>
                                <td class="text-center"><?= En2BD_Digit($tax->previous_fiscal_year); ?></td>
                                <td class="text-center"><?= En2BD_Digit(BDT($present_due)); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
            </fieldset>
            
            
            
            <fieldset class="hide_on_print">
                <legend>Data Entry Information </legend>
                <table class="table table-bordered table-bordered table-striped mb-4">
                    <tr><td width="250">Register By</td><td width="5">:</td><td><?php echo $created_by . ' on '. ($created_at); ?></td></tr>
                    <tr><td>Updated By</td><td>:</td><td><?php echo $updated_by . ' on '. ($updated_at); ?></td></tr>                                        
                </table>
            </fieldset>
        </div>
        
        <div class="box-footer text-center hide_on_print">
            <a href="<?php echo site_url(Backend_URL . 'member') ?>" class="btn btn-default">
                <i class="fa fa-long-arrow-left"></i> 
                Back to List
            </a>
                
            
            <a href="<?php echo site_url(Backend_URL . 'member/update/' . $id) ?>" class="btn btn-primary <?= $role_class; ?>"> 
               <i class="fa fa-edit"></i> Edit
            </a>
            
            <span onclick="print(document);" class="btn btn-warning <?= $role_class; ?>"> 
               <i class="fa fa-print"></i> Print
            </span>
        </div>
    </div>
</section>