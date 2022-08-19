<?php load_module_asset('profile', 'css' );?>
<?php load_module_asset('profile', 'js' );?>

<section class="content-header">
    <h1>My Account <small>Update Profile</small>  </h1>
	<ol class="breadcrumb">
        <li><a href="<?php echo Backend_URL ?>"><i class="fa fa-user"></i> Admin</a></li>
        <li><a href="<?php echo Backend_URL . 'profile' ?>"><i class="fa fa-dashboard"></i> Profile</a></li>
        <li class="active">Update Profile</li>
    </ol>
</section>


<section class="content">    
    <?php echo Profile_helper::makeTab('#'); ?>            
    <div class="box no-border">       
        <div class="box-body">
            <div class="col-md-12"><div id="ajax_respond"></div></div>
            <form method="post" id="update_profile_info">

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo $full_name; ?>">
                    </div>                    
                    <div class="form-group">
                        <label for="text">Mobile Number</label>
                        <input type="text" class="form-control" name="contact" value="<?php echo $contact; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Contact Email</label>
                        <input type="email" class="form-control readonly" name="user_email" readonly="readonly" value="<?php echo $email; ?>">
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 pull-right">
                            <button type="button" onclick="update_profile();"  class="pull-right btn btn-sm btn-success">Update</button>
                        </div>                                    
                    </div>                    
                </div>
            </form>
        </div>
    </div>
</section>
