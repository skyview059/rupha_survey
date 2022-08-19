<?php load_module_asset('user', 'css' );?>
<?php load_module_asset('user', 'js' );?>   
<section class="content-header">
    <h1> Role  <small>Permission Management</small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?= Backend_URL; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="">
            <div class="col-md-8 col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            Role / Label
                        </h3>
                    </div>
                    <div class="box-body">
                        <div id="ajaxRespond"></div>                        
                        <div class="table-responsive" >
                            <table class="table table-striped table-hover">
                                <tbody>
                                    <tr>
                                        <th width="20">#</th>
                                        <th>Role/Label</th>                                    
                                        <th class="text-center" width="100">Users</th>
                                        <th class="text-center" width="210">Action</th>
                                    </tr>
                                    <?php foreach ($roles as $role ) { ?>
                                    <tr class="role_id_<?= $role->id; ?>">
                                        <td><?= $role->id; ?></td>                                        
                                        <td class="edit_id_<?= $role->id; ?>"><?= $role->role_name; ?></td>
                                        <td class="text-center"><span class="badge bg-light-blue"><?= $role->totalUser; ?></span></td>
                                        <td class="text-center">
                                            <span onClick="manage_acl(<?= $role->id; ?>)" class="btn btn-default btn-xs">
                                                <i class="fa fa fa-cogs"></i>
                                                ACL
                                            </span>
                                            <span onClick="edit_role(<?= $role->id; ?>)" class="btn btn-default btn-xs">
                                                <i class="fa fa-edit"></i> 
                                                Rename
                                            </span>
                                            <?php // Users_helper::Delete($role->id, $role->status); ?>
                                        </td>                                            
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>                                  
                    </div>
                </div>
            </div>



            <div class="col-md-4 col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            <i class="fa fa-user-plus" aria-hidden="true"></i>
                            Add New Role
                        </h3>
                    </div>

                    <div class="box-body">
                        <div id="ajaxRespondID" style="display:none;">Ajax Message Will Display Here</div>
                        <form id="role" method="post" role="form"  action="<?php Backend_URL; ?>users/roles/create">
                            <div class="form-group">
                                <label for="roleName">Role Name <sup>*</sup></label>
                                <input type="text" name="role_name" id="role_name" class="form-control" required="required"  data-error="Please enter role name" />
                                <div class="help-block with-errors"></div>
                            </div>
                            <button type="button" onClick="add_new_role(event);" class="btn btn-success">Create New Role</button>
                        </form>
                    </div>                
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="manageAcl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" id="access_permission">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Grand Access with this Role</h4>
                    </div>

                    <div class="modal-body" >
                        <div class="js_update_respond"></div>
                        <div class="acl_respond" style="min-height:200px; max-height:450px; overflow-y:scroll; padding-right: 10px;"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><span aria-hidden="true">&times;</span> Close</button>
                        <button type="button" class="btn btn-primary " onclick="module_manage();"><i class="fa fa-save"></i> Grand Access</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
