<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<section class="content-header">
    <h1> Union  <small>Control panel</small> <?php echo anchor(site_url(Backend_URL . 'union/create'), ' + Add New', 'class="btn btn-default"'); ?> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url(Backend_URL) ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Union</li>
    </ol>
</section>

<section class="content">       
    <div class="box">            
        <div class="box-header with-border">                                               
            <form action="<?php echo site_url(Backend_URL . 'union'); ?>" class="form-inline" method="get">
                <div class="input-group">
                    <select name="division_id" class="form-control" id="division_id">
                        <?php echo Helper::getDivisions($division_id); ?>
                    </select>                       
                </div>

                <div class="input-group">
                    <select name="district_id" class="form-control" id="district_id">
                        <?php echo Helper::getDistricts($district_id, $division_id); ?>
                    </select>                        
                </div>

                <div class="input-group">
                    <select name="upazilla_id" class="form-control" id="upazilla_id">
                        <?php echo Helper::getUpazilas($upazilla_id, $district_id); ?>
                    </select>                        
                </div>

                <div class="input-group">
                    <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                    <span class="input-group-btn">                            
                        <a href="<?php echo site_url(Backend_URL . 'union'); ?>" class="btn btn-default">Reset</a>                            
                        <button class="btn btn-primary" type="submit">Search/Filter</button>
                    </span>
                </div>
            </form>            
        </div>

        <div class="box-body">            
            <div class="table-responsive">
                <table class="table table-striped table-condensed">
                    <thead>
                        <tr>
                            <th width="40">S/L</th>
                            <th>Upazilla</th>
                            <th>Bangla Name </th>
                            <th>English Name</th>
                            <th width="200">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($unions as $union) { ?>
                            <tr>
                                <td><?php echo ++$start; ?></td>
                                <td><?php echo $union->upazilla; ?></td>
                                <td><?php echo $union->bn_name; ?></td>
                                <td><?php echo $union->name; ?></td>
                                
                                <td>
                                    <?php                                    
                                    echo anchor(site_url(Backend_URL . 'union/update/' . $union->id), '<i class="fa fa-fw fa-edit"></i> Update ', 'class="btn btn-xs btn-warning"');
                                    echo anchor(site_url(Backend_URL . 'union/delete/' . $union->id), '<i class="fa fa-fw fa-trash"></i> ', 'class="btn btn-xs btn-danger"');
                                    ?>
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
                    <span class="btn btn-primary">Total Union: <?php echo $total_rows ?></span>
                </div>
                <div class="col-md-6 text-right">
                    <?php echo $pagination ?>
                </div>                
            </div>            
        </div>
        
    </div>
</section>
<?php   load_module_asset('member', 'js'); ?>