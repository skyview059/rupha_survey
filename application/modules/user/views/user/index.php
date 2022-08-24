<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1> User  <small>Control panel</small> <?php echo anchor(site_url(Backend_URL . 'user/create'), ' + Add New', 'class="btn btn-default"'); ?> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(Backend_URL) ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">User</li>
    </ol>
</section>

<section class="content">       
    <div class="box">            
        <div class="box-header with-border">                                   
            <div class="col-md-3 col-md-offset-9 text-right">
                <form action="<?php echo site_url(Backend_URL . 'user'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php if ($q <> '') { ?>
                                <a href="<?php echo site_url(Backend_URL . 'user'); ?>" class="btn btn-default">Reset</a>
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
                <table class="table table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th width="40">S/L</th>
                            <th>Role</th>
                            <th>Area</th>
                            <th>Full Name</th>                            
                            <th>Email</th>                            
                            <th>Contact</th>
                            <th>Created</th>
                            <th>Last Access</th>
                            <th>Status</th>
                            <th class="text-center" width="160">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($users as $user) { ?>
                            <tr>
                                <td><?php echo ++$start; ?></td>
                                <td><?php echo $user->role_name; ?></td>
                                <td>
                                    <?php if(in_array($user->role_id, [3,4])){?>
                                    <?php echo $user->union_name; ?><br/>
                                    <?php echo $user->upazila_name.', '.$user->district_name.', '.$user->division_name; ?><br/>
                                    <?php }?>
                                </td>
                                <td><?php echo $user->full_name; ?></td>                                
                                <td><?php echo $user->email; ?></td>                                
                                <td><?php echo $user->contact; ?></td>
                                <td><?php echo date('d-M-y h:i A', strtotime($user->created_at)); ?></td>
                                <td><?php echo $user->last_access; ?></td>
                                <td><?php echo $user->status; ?></td>
                                <td>
                                    <?php
                                    echo anchor(site_url(Backend_URL . 'user/profile/' . $user->id), '<i class="fa fa-fw fa-external-link"></i> View', 'class="btn btn-xs btn-primary"');
                                    echo anchor(site_url(Backend_URL . 'user/update/' . $user->id), '<i class="fa fa-fw fa-edit"></i> Edit', 'class="btn btn-xs btn-warning"');
                                    echo anchor(site_url(Backend_URL . 'user/delete/' . $user->id), '<i class="fa fa-fw fa-times"></i>', 'class="btn btn-xs btn-danger"');
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>


            <div class="row">                
                <div class="col-md-6">
                    <span class="btn btn-primary">Total User: <?php echo $total_rows ?></span>

                </div>
                <div class="col-md-6 text-right">
                    <?php echo $pagination; ?>
                </div>                
            </div>
        </div>
    </div>
</section>