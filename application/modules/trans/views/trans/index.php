<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1> Income  <small>Control panel</small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(Backend_URL) ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Income</li>
    </ol>
</section>

<section class="content">  
    <?php echo transTabs(''); ?>    
     <div class="box no-border">          
        <div class="box-header with-border">                                   
            <h3 class="box-title text-bold">List of all Income</h3>
        </div>
        
        <div class="box-header with-border">                                
            <?php $this->load->view('index-filter'); ?>            
        </div>

        <div class="box-body">            
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th width="40">S/L</th>
                            <th>Member</th>
                            <th>Head</th>
                            <th>Sub Head</th>
                            <th>Month of DPS </th>                            
                            <th>Trans Date</th>                            
                            <th class="text-right">Withdraw</th>
                            <th class="text-right">Deposit</th>                                         
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($incomes as $income) {  ?>
                            <tr>
                                <td><?php echo ++$start; ?></td>
                                <td><?php echo $income->name; ?></td>
                                <td><?php echo $income->head_name; ?></td>
                                <td><?php echo $income->sub_head; ?></td>
                                <td><?php echo $income->dps_month; ?></td>
                                <td><?php echo $income->trans_date; ?></td>                                
                                <td class="text-right"><?php echo BDT($income->dr); ?></td>
                                <td class="text-right"><?php echo BDT($income->cr); ?></td>                                
                                <td class="text-center">
                                    <span class="btn btn-danger btn-xs">
                                        <i class="fa fa-ban"></i>
                                        Void
                                    </span>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
         
         <div class="box-footer">
             <div class="row">                
                <div class="col-md-6">
                    <span class="btn btn-primary">Total: <?php echo $total_rows; ?></span>
                </div>
                <div class="col-md-6 text-right">
                    <?php echo $pagination; ?>
                </div>                
            </div>
         </div>         
    </div>
</section>