<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1> Monthly DPS  <small>Control panel</small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(Backend_URL) ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">DPS</li>
    </ol>
</section>

<section class="content">  
    <?php echo transTabs(''); ?>    
     <div class="box no-border">          
        <div class="box-header with-border">                                   
            <h3 class="box-title text-bold">Members Transection</h3>
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
                            <th width='90'>Trans Date</th>  
                            <th>Member</th>                           
                            <th class="text-right">Withdraw</th>
                            <th class="text-right">Deposit</th>                                         
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($dpss as $dps) {  ?>
                            <tr>
                                <td><?= ++$start; ?></td>                                
                                <td><?= $dps->trans_date; ?></td>   
                                <td><?= $dps->name; ?></td>                             
                                <td class="text-right"><?php echo BDT($dps->dr); ?></td>
                                <td class="text-right"><?php echo BDT($dps->cr); ?></td>                                
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
                    <span class="btn btn-primary">Total: <?php echo $total_rows ?></span>
                </div>
                <div class="col-md-6 text-right">
                    <?php echo $pagination; ?>
                </div>                
            </div>
        </div>
    </div>
</section>