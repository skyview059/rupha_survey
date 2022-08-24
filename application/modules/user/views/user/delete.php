<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php load_module_asset('user','css'); ?>
<section class="content-header">
    <h1>User  <small>Delete</small> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url( Backend_URL )?>"><i class="fa fa-dashboard"></i> Admin</a></li>
	<li><a href="<?php echo Backend_URL ?>user">User</a></li>
        <li class="active">Delete</li>
    </ol>
</section>

<section class="content">
    <?php echo userTabs($id, 'delete'); ?>
    <div class="box no-border">
        <div class="box-header with-border">
            <h3 class="box-title">Preview Before Delete</h3>
        </div>
        <table class="table table-striped">
	    <tr><td width="150">Role Name</td><td width="5">:</td><td><?php echo $role_name; ?></td></tr>
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
	</table>
	<div class="box-header">
			 <?php echo anchor(site_url(Backend_URL .'user/delete_action/'.$id),'<i class="fa fa-fw fa-trash"></i> Confrim Delete ', 'class="btn btn-danger" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); ?>
	</div>
	</div></section>