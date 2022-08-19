<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1> Expense  <small>Control panel</small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(Backend_URL) ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Expense</li>
    </ol>
</section>

<section class="content">      
    <?php echo transTabs('expense'); ?>    
     <div class="box no-border">        
        <div class="box-header with-border">                                               
            <?php echo $this->load->view('expense-filter'); ?>   
        </div>

        <div class="box-body">
            <?php echo $this->session->flashdata('message'); ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th width="40">S/L</th>
                            <th>Trans Date</th>
                            <th>Head</th>
                            <th>Sub Head</th>
                            <th>Remark</th>
                            <th>Entry User</th>                            
                            <th class="text-right">Amount</th>
                            <th class="text-center" width="100">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($expenses as $expense) { ?>
                            <tr>
                                <td><?php echo ++$start; ?></td>
                                <td><?php echo bdDateFormat($expense->trans_date); ?></td>
                                <td><?php echo $expense->head_name; ?></td>
                                <td><?php echo $expense->sub_head; ?></td>
                                <td><?php echo $expense->remark; ?></td>
                                <td><?php echo $expense->full_name; ?></td>                                
                                <td class="text-right"><?php echo BDT($expense->amount); ?></td>
                                <td class="text-center">
                                    <?php
                                    echo anchor(
                                            site_url(Backend_URL . 'trans/ajax/void/' . $expense->id), 
                                            '<i class="fa fa-fw fa-ban"></i> Void ', 
                                            'class="btn btn-xs btn-danger"'
                                        );
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>


            <div class="row">                
                <div class="col-md-6">
                    <span class="btn btn-primary">Total Expense: <?php echo $total_rows ?></span>

                </div>
                <div class="col-md-6 text-right">
                    <?php echo $pagination ?>
                </div>                
            </div>
        </div>
    </div>
</section>