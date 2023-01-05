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

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Member Statistics</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Sectary Name</th>
                            <th>Union</th>
                            <th class="text-center">Today</th>
                            <th class="text-center">Last 7 Days</th>
                            <th class="text-center">Current Month</th>
                            <th class="text-center">Current Year</th>
                            <th class="text-center">Lifetime</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        if (!empty($statistics)) {
                            foreach ($statistics as $userId => $user) {
                                ?>
                                <tr>
                                    <td><?php echo anchor(site_url(Backend_URL . 'member?user_id=' . $userId), $user['full_name'], 'class=""'); ?></td>
                                    <td>
                                        <h5><?= $user['union_info']->union_bn_name; ?> ইউনিয়ন পরিষদ</h5>
                                        <p>উপজেলা: <?= $user['union_info']->upazila_bn_name; ?>, <?= $user['union_info']->district_bn_name; ?>, <?= $user['union_info']->division_bn_name; ?></p>
                                    </td>
                                    <td class="text-center"><?= $user['today_count'] ?></td>
                                    <td class="text-center"><?= $user['last_7_day_count'] ?></td>
                                    <td class="text-center"><?= $user['current_month_count'] ?></td>
                                    <td class="text-center"><?= $user['current_year_count'] ?></td>
                                    <td class="text-center"><?= $user['lifetime_count'] ?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="box-footer"></div>
    </div>

</section>