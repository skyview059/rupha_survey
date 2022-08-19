<form method="get" class="form-inline hide_on_print">
    <div class="row">     
        
        <div class="col-md-3">
            <div class="input-group">
                <span class="input-group-addon"> Bank</span>
                <select class="form-control" name="bank_id" id="bank_id">                                    
                    <?php echo getBankList( $bank_id ); ?>
                </select>                             
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i> From</span>
                <input type="text" name="date_from" value="<?php echo $date_from; ?>" placeholder="Click" class="form-control js_datepicker" readonly="readonly"/>
            
                <span class="input-group-addon"><i class="fa fa-calendar"></i> To</span>
                <input type="text" name="date_to" value="<?php echo $date_to; ?>"  placeholder="Click"  class="form-control js_datepicker" readonly="readonly"/>
            </div>
        </div>
        
        <div class="col-md-2">
            <div class="input-group">
                <input type="submit" value="Filter" class="btn btn-primary"/>
                <span class="input-group-btn"><button type="button" onclick="location.href = 'bank/trans';" class="btn btn-info"> Reset</button></span>
            </div>
        </div>        
    </div>    
</form>
