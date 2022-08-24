<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php load_module_asset('user','css'); ?>
<section class="content-header">
    <h1>User  <small>Read</small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url( Backend_URL )?>"><i class="fa fa-dashboard"></i> Admin</a></li>
	<li><a href="<?php echo site_url( Backend_URL .'user' )?>">User</a></li>
        <li class="active">Details</li>
    </ol>
</section>

<section class="content">
    <?php echo userTabs($id, 'read'); ?>
    <div class="box no-border">
        
        <div class="box-header with-border">
            <h3 class="box-title">Details View</h3>
            <?php echo $this->session->flashdata('message'); ?>
        </div>
        <table class="table table-striped">
	    <tr><td width="150">Role</td><td width="5">:</td><td><?php echo $role_name; ?></td></tr>
        <?php if(in_array($role_id, [3,4])){?>
	    <tr>
            <td width="150">Area</td>
            <td width="5">:</td>
            <td>
                <?php echo $union_name; ?><br/>
                <?php echo $upazila_name.', '.$district_name.', '.$division_name; ?><br/>
            </td>
        </tr>
        <?php }?>
	    <tr><td width="150">Full Name</td><td width="5">:</td><td><?php echo $full_name; ?></td></tr>	    
	    <tr><td width="150">Email</td><td width="5">:</td><td><?php echo $email; ?></td></tr>
	    
	    <tr><td width="150">Contact</td><td width="5">:</td><td><?php echo $contact; ?></td></tr>
	    <tr><td width="150">Created</td><td width="5">:</td><td><?php echo $created_at; ?></td></tr>
	    <tr><td width="150">Last Access</td><td width="5">:</td><td><?php echo $last_access; ?></td></tr>
	    <tr><td width="150">Status</td><td width="5">:</td><td><?php echo $status; ?></td></tr>
	    <tr><td></td><td></td><td><a href="<?php echo site_url( Backend_URL .'user') ?>" class="btn btn-default"><i class="fa fa-long-arrow-left"></i> Back</a><a href="<?php echo site_url( Backend_URL .'user/update/'.$id ) ?>" class="btn btn-primary"> <i class="fa fa-edit"></i> Edit</a></td></tr>
	</table>
	</div></section>