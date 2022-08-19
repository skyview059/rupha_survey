<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1>Bank   <small>Transection</small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(Backend_URL) ?>"><i class="fa fa-dashboard"></i> Admin</a></li><li><a href="<?php echo site_url(Backend_URL . 'bank') ?>">Bank</a></li>
        <li class="active">Details</li>
    </ol>
</section>

<section class="content">
    <?php echo transTabs('bank'); ?>    
    <div class="box no-border">
        <div class="show_on_print text-center">
            <h1 class="no-margin no-padding"><?php echo getSettingItem('ComName'); ?></h1>
            <p>Bank Statement</p>
        </div>
        <div class="box-header with-border">
            <?php $this->load->view('bank_filter'); ?>
        </div>



        <div class="box-body">

            <div class="table-responsive">

                <table class="table table-bordered table-striped table-condensed">
                    <thead>
                        <tr>
                            <th width="40">S/L</th>                                                
                            <th width="90">Date</th>
                            <th width="350">Bank Account</th>
                            <th>Remark</th>                        
                            
                            <th class="text-right" width="120">Deposit</th>
                            <th class="text-right" width="120">Withdraw</th>
                            <th class="text-center" width="60">Action</th>
                            
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $sl = $total_deposit = $total_withdraw = 0;
                        foreach ($trans as $tran) {
                            $sl++;
                            $total_deposit += $tran->deposit;
                            $total_withdraw += $tran->withdraw;
                            ?>
                            <tr id="tx_<?php echo ($tran->id); ?>">
                                <td><?php echo $sl; ?></td>                                                        
                                <td><?php echo globalDateFormat($tran->trans_date); ?></td>
                                <td>
                                    <a href="bank/stmt/<?php echo ($tran->bank_id); ?>">
                                        <?php echo ($tran->account_name .', '. $tran->account_no . ' ('. $tran->bank_name . ')'); ?>
                                    </a>                                    
                                </td>
                                <td><?php echo $tran->remark; ?></td>
                                
                                <td class="text-right"><?php echo BDT($tran->deposit); ?></td>
                                <td class="text-right"><?php echo BDT($tran->withdraw); ?></td>
                                <td class="text-center">
                                    <span class="btn btn-xs btn-danger"                                       
                                       onclick="trans_void(<?php echo $tran->id .','.$tran->bank_id; ?>);">
                                        <i class="fa fa-ban"></i> Void
                                    </span>
                                </td>
                                
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-right"> Total = </th>
                            <th class="text-right"><?php echo BDT($total_deposit); ?></th>
                            <th class="text-right"><?php echo BDT($total_withdraw); ?></th>
                            <th class="text-right"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="box-footer">
            <div class="hide_on_print">
                <span onclick="print(document);" class="btn btn-primary">
                    <i class="fa fa-print"></i> Print Statement
                </span>
            </div>
        </div>
    </div>	
</section>
<?php load_module_asset( 'bank','js');  ?>