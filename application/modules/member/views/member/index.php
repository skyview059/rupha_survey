<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1> Member  <small>Control panel</small> 
        
        <?php echo anchor(site_url(Backend_URL . 'member/create'), '<i class="fa fa-user-plus"></i> New Registration', 'class="btn btn-default"'); ?> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(Backend_URL) ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Member</li>
    </ol>
</section>

<section class="content">       
    <div class="box">            
        <div class="box-header with-border">
             
            <form action="<?php echo site_url(Backend_URL . 'member'); ?>" class="form-inline" method="get">
                <div class="input-group">
                    <span class="input-group-addon"> Limit</span>
                    <select name="limit" class="form-control">
                        <?php echo numericDropDown(50,500,100, $limit );?>
                    </select>                            
                </div>
                
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Keyword" name="q" value="<?php echo $q; ?>">
                    <span class="input-group-btn">                                                                                                
                        <button class="btn btn-primary" type="submit">Search</button>
                        <a href="<?php echo site_url(Backend_URL . 'member'); ?>" class="btn btn-default">Reset</a>
                    </span>
                </div>
            </form>
                 
        </div>

        <div class="box-body">                        
            <?php echo $this->session->flashdata('message'); ?>
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-condensed">
                    <thead>
                        <tr>                            
                            <th width="40">Ref.ID</th>                            
                            <th width="50">Picture</th>
                            <th>Name</th>                                                               
                            <th width="100">Contact</th>
                            <th width="100" class="text-right">Withdraw &nbsp;</th>
                            <th width="100" class="text-right text-green">Deposit &nbsp;</th>
                            <th width="100" class="text-right text-red">Balance &nbsp;</th>
                            <th width="90" class="text-right">Joined</th>                            
                            <th width="150" class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php 
                        
                        $t_dr = $t_cr = 0;
                        
                        foreach ($members as $m) {                            
                            $t_dr += $m->dr_tk;
                            $t_cr += $m->cr_tk;
                            ?>
                            <tr>
                                <td><?php echo memberID($m->ref_id); ?></td>                                
                                <td><img src="<?php echo getPhoto($m->photo); ?>" class="img-responsive img-circle"></td>                                        
                                <td>
                                    <?php 
                                echo anchor(
                                        site_url(Backend_URL . 'member/profile/' . $m->id), $m->name . ' &nbsp;<i class="fa fa-external-link"></i>' );
                                
                                ?>
                                </td>                                
                                
                                <td><?php echo bdContactNumber($m->contact); ?></td>                                
                                <td class="text-right"><?php echo BDT($m->dr_tk); ?></td>
                                <td class="text-right"><?php echo BDT($m->cr_tk); ?></td>                                
                                <td class="text-right text-green text-bold"><?php echo BDT($m->dr_tk - $m->cr_tk); ?></td>                                
                                <td class="text-right"><?php echo globalDateFormat($m->join_date); ?></td>                                
                                <td class="text-center">
                                    <?php
                                    echo anchor(site_url(Backend_URL . 'member/stmt/' . $m->id), '<i class="fa fa-fw fa-bars"></i> Bills &#2547; ', 'class="btn btn-xs btn-primary"');
                                    echo anchor(site_url(Backend_URL . 'member/update/' . $m->id), '<i class="fa fa-fw fa-edit"></i> Edit', 'class="btn btn-xs btn-warning"');                                    
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tr>
                        <th class="text-right" colspan="4">Total = </th>
                        <th class="text-right"><?php echo BDT($t_dr); ?></th>
                        <th class="text-right"><?php echo BDT($t_cr); ?></th>
                        <th class="text-right"><?php //echo BDT($t_paid); ?></th>
                        <th class="text-right"></th>
                        <th></th>                        
                    </tr>
                </table>
            </div>


            <div class="row">                
                <div class="col-md-6">
                    <span class="btn btn-primary">Total: <?php echo $total_rows ?></span>
                </div>
                <div class="col-md-6 text-right">
                    <?php echo $pagination; ?>
                </div>                
            </div>
        </div>
    </div>
</section>