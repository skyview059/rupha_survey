<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1> SMS  <small>Sent Log</small> 
        <?php echo anchor(
                site_url(Backend_URL . 'sms/write'), 
                ' + Send New', 
                'class="btn btn-default"'
            ); 
        ?>
        <span class="btn btn-success refresh"><i class="fa fa-refresh"></i> Refresh Counting </span>
    </h1>
    <div id="respond"></div>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(Backend_URL) ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">SMS</li>
    </ol>
</section>

<section class="content">       
    <div class="box">            
        <div class="box-header with-border"> 
            <div class="row">
                <div class="col-md-5">
                    <h3 class="box-title text-bold">Total SMS Sent: <span class="text-red"><?php echo $total_sent; ?></span></h3>
                </div>
           
                <div class="col-md-3 pull-right text-right">
                    <form action="<?php echo site_url(Backend_URL . 'sms'); ?>" class="form-inline" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                            <span class="input-group-btn">
                                <?php if ($q <> '') { ?>
                                    <a href="<?php echo site_url(Backend_URL . 'sms'); ?>" class="btn btn-default">Reset</a>
                                <?php } ?>
                                <button class="btn btn-primary" type="submit">Search</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="box-body">
            <?php echo $this->session->flashdata('message'); ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th width="40">S/L</th>
                            <th width="120">Donor</th>
                            <th width="150">Phone</th>
                            <th>Body</th>
                            <th>Type</th>
                            <th class="text-center">Qty</th>
                            <th width="150">Sent</th>
                            <th width="90">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($smss as $sms) { ?>
                            <tr id="sms_<?php echo $sms->id; ?>">
                                <td><?php echo ++$start ?></td>
                                <td><?php echo $sms->member; ?></td>
                                <td><?php echo $sms->phone; ?></td>
                                <td><?php echo nl2br($sms->body); ?></td>
                                <td><?php echo $sms->type; ?></td>
                                <td class="text-center"><?php echo $sms->qty; ?></td>
                                <td><?php echo bdDateTimeFormat($sms->timestamp); ?></td>
                                <td><?php echo deliveryStatus($sms->respond); ?></td>
                            </tr>
                            <?php if($role_id==1){?>
                            <tr id="log_<?php echo $sms->id; ?>" class="hidden">
                                <td>Log: </td>
                                <td colspan="7">
                                    <span class="text-red"><?php echo ($sms->respond); ?></span> 
                                    <span class="btn btn-xs btn-danger remove" id="<?php echo $sms->id; ?>">
                                        <i class="fa fa-times"></i> 
                                        Remove
                                    </span>
                                </td>
                            </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>


            <div class="row">                
                <div class="col-md-6">
                    <span class="btn btn-primary">Total Sent SMS: <?php echo $total_rows ?></span>

                </div>
                <div class="col-md-6 text-right">
                    <?php echo $pagination ?>
                </div>                
            </div>
        </div>
    </div>
</section>
<script>
    $('.remove').on('click', function(){
        var id = $(this).attr('id');
        var yes = confirm('Confirm Delete');
        if(yes){
            $.ajax({
                url: 'sms/delete',
                type: "POST",
                dataType: "json",
                data: { id: id },
                beforeSend: function(){
                    $(`#sms_${id}`).css('background-color','red');
                    $(`#log_${id}`).css('background-color','red');
                },
                success: function( jsonData ){
                    if(jsonData.Status === 'OK'){
                        $(`#sms_${id}`).fadeOut('Slow');                    
                        $(`#log_${id}`).fadeOut('Slow');                    
                    } else {
                        $(`#sms_${id}`).css('background-color','none');
                        $(`#log_${id}`).css('background-color','none');
                    }                                    
                }
            }); 
        }
    });
    
    $('.refresh').on('click', function(){       
        $.ajax({
            url: 'sms/refresh_qty',
            type: "POST",
            dataType: "HTML",
            beforeSend: function(){
                $('.refresh i').addClass('fa-spin fa-refresh').removeClass('fa-check-square-o');
                $('#respond').css('display','block').html('<p class="ajax_processing">Loading...</p>');
            },
            success: function( respond ){                    
                $('#respond').html( respond );
                $('.refresh i').removeClass('fa-spin fa-refresh').addClass('fa-check-square-o');
                setTimeout(function(){ location.reload(); }, 2000);                
            }
        });
    });
</script>