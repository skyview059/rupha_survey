<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1>
        Dashboard
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<?php load_module_asset('dashboard', 'css'); ?>
<section class="content">
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?= $today_count+0;?></h3>
                    <p>Today</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
            </div>
        </div>
        
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><?= $last_7_day_count+0;?></h3>
                    <p>Last 7 Days</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3><?= $current_month_count+0;?></h3>
                    <p>Current Month</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3><?= $lifetime_count+0;?></h3>
                    <p>Lifetime</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Latest Member of <?= $union_info->union_name ?> </h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th width="50">ক্রমিক নং</th>
                            <th>পূর্ববর্তী হোল্ডিং নাম্বার</th>
                            <th>বর্তমান হোল্ডিং নাম্বার</th>
                            <th>ওয়ার্ড নং</th>
                            <th>গ্রাম/মহল্লার নাম</th>
                            <th>নাম</th>
                            <th>মোবাইল নং</th>
                            <th>পিতা/স্বামী</th>
                            <th>মাতা</th>
                            <th>জন্ম তারিখ</th>
                            <th>জাতীয় পরিচয়পত্র/জন্ম নিবন্ধন নং</th>
                            <th>সামাজিক সুরক্ষার সুবিধা</th>
                            <th>আয়ের উৎস</th>
                            <th>খানা সদস্য সংখ্যা</th>
                            <th width="50">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($members as $member) { ?>
                            <tr>
                                <td><?php echo ++$start ?></td>
                                <td><?php echo $member->previous_holding_no; ?></td>
                                <td><?php echo $member->present_holding_no; ?></td>
                                <td><?php echo $member->word_no; ?></td>
                                <td><?php echo $member->village; ?></td>
                                <td><?php echo $member->khana_chief_name_ba . ' <br/>' . $member->khana_chief_name_en; ?></td>
                                <td><?php echo $member->mobile_no; ?></td>
                                <td><?php echo $member->father_name; ?></td>
                                <td><?php echo $member->mother_name; ?></td>
                                <td><?php echo $member->date_of_birth; ?></td>
                                <td><?php echo $member->nid; ?></td>
                                <td><?php echo $member->ssb_name; ?></td>
                                <td><?php echo $member->income_source_name; ?></td>
                                <td><?php echo $member->house_members; ?></td>
                                <td>
                                    <?php
                                    echo anchor(site_url(Backend_URL . 'member/read/' . $member->id), '<i class="fa fa-fw fa-external-link"></i> View', 'class="btn btn-xs btn-primary"');
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box-footer"></div>
    </div>
</section>

<?php // load_module_asset('dashboard','js'); 
?>