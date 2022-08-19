<form action="<?php echo site_url(Backend_URL . 'trans'); ?>" class="form-inline" method="get">
    <div class="input-group">
        <span class="input-group-addon"> Status </span>
        <select name="status" class="form-control">
            <?php echo selectOptions($status,array(
                'OK' => 'OK',
                'Void' => 'Void',
            )); ?>
        </select>                            
    </div>
    
    <div class="input-group">
        <span class="input-group-addon"> Limit</span>
        <select name="limit" class="form-control">
            <?php echo numericDropDown(100,1000,100, $limit );?>
        </select>                            
    </div>
        
    <div class="input-group">        
        <span class="input-group-btn">                                                                                                
            <button class="btn btn-primary" type="submit">Search</button>
            <a href="<?php echo site_url(Backend_URL . 'trans'); ?>" class="btn btn-default">Reset</a>
        </span>
    </div>
</form>