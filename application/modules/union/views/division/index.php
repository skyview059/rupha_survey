<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1> Division  <small>Control panel</small> <?php echo anchor(site_url( Backend_URL . 'union/division/create'),' + Add New', 'class="btn btn-default"'); ?> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url( Backend_URL )?>"><i class="fa fa-dashboard"></i> Admin</a></li>
	<li><a href="<?php echo Backend_URL ?>union">Union</a></li>
	<li class="active">Division</li>
    </ol>
</section>

<section class="content">       
    <div class="box">            
        <div class="box-header with-border">                                   
            <div class="col-md-3 col-md-offset-9 text-right">
                <form action="<?php echo site_url( Backend_URL .'union/division'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php if ($q <> '') { ?>
                                <a href="<?php echo site_url( Backend_URL .'union/division'); ?>" class="btn btn-default">Reset</a>
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
            <table class="table table-hover table-condensed">
                <thead>
                    <tr>
                    	<th width="40">S/L</th>
		<th>Name</th>
		<th>Bn Name</th>
		<th width="200">Action</th>
                    </tr>
                </thead>

                <tbody>
	<?php foreach ($divisions as $division) { ?>
                    <tr>
		<td><?php echo ++$start ?></td>
		<td><?php echo $division->name; ?></td>
		<td><?php echo $division->bn_name; ?></td>
		<td>
			<?php 
			echo anchor(site_url(Backend_URL .'union/division/read/'.$division->id),'<i class="fa fa-fw fa-external-link"></i> View', 'class="btn btn-xs btn-primary"'); 
			echo anchor(site_url(Backend_URL .'union/division/update/'.$division->id),'<i class="fa fa-fw fa-edit"></i> Edit',  'class="btn btn-xs btn-warning"'); 
			echo anchor(site_url(Backend_URL .'union/division/delete/'.$division->id),'<i class="fa fa-fw fa-trash"></i> Delete ', 'class="btn btn-xs btn-danger"'); 
			?>
		</td>
                    </tr>
                <?php } ?>
                    </tbody>
                </table>
            </div>
        
        
            <div class="row">                
                <div class="col-md-6">
                    <span class="btn btn-primary">Total Union: <?php echo $total_rows ?></span>
	    
                </div>
                <div class="col-md-6 text-right">
                    <?php echo $pagination ?>
                </div>                
            </div>
        </div>
    </div>
</section>