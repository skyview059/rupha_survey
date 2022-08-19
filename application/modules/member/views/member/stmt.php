<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1> Member  <small>Statement</small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(Backend_URL) ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Member</li>
    </ol>
</section>

<section class="content">
    <?php echo memberTabs($id, 'stmt'); ?>
    <div class="box no-border">            
        
        <div class="box-header text-center with-border">
            <h3 class="box-title"><?php echo $name; ?></h3>
            <p><?php echo $address .', '. $contact; ?></p>
        </div>
        <div class="box-body">            
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th width="40">S/L</th>                            
                            <th width="80">Trans Date</th>
                            <th>Entry By</th>
                            <th>Remark</th>                            
                            <th width="80" class="text-right">Dr(Withdraw)</th>
                            <th width="50" class="text-right text-green">Cr(Deposit)</th>                                                                                    
                            <th width="80" class="text-right text-green">Balance</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php 
                        $ob = 0;
                        $t_dr = $t_cr = $t_balance = 0;
                        
                        foreach ($stmts as $stmt) {   
                            $t_dr += $stmt->dr;
                            $t_cr += $stmt->cr;
                            $t_balance += ($stmt->cr - $stmt->dr);
                            $ob = $ob + $stmt->cr - $stmt->dr;
                            ?>
                            <tr>
                                <td><?php echo ++$start; ?></td>                                                                
                                <td><?php echo paidDate($stmt->trans_date); ?></td>                                
                                <td><?php echo Helper::getUserName($stmt->user_id); ?></td>                                
                                <td><?php echo $stmt->remark; ?></td>
                                <td class="text-right"><?php echo BDT($stmt->dr); ?></td>
                                <td class="text-right"><?php echo BDT($stmt->cr); ?></td>                                
                                <td class="text-right text-green"><?php echo BDT($ob); ?></td>                                                               
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tr>
                        <th class="text-right" colspan="4">Total = </th>
                        <th class="text-right"><?= BDT($t_dr); ?></th>
                        <th class="text-right"><?= BDT($t_cr); ?></th>                                               
                        <th class="text-right"><?= BDT($t_balance); ?></th>                        
                    </tr>
                </table>
            </div>           
        </div>
    </div>
</section>