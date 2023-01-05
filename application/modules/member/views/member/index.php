<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<section class="content-header">
	<h1> Member <small>Control panel</small> <?php echo (in_array($role_id, [3,4])) ? anchor(site_url(Backend_URL . 'member/create'), ' + Add New', 'class="btn btn-default"') : ''; ?> </h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo site_url(Backend_URL) ?>"><i class="fa fa-dashboard"></i> Admin</a></li>
		<li class="active">Member</li>
	</ol>
</section>
<?php echo $this->session->flashdata('message'); ?>
<section class="content">
	<div class="box">
		<div class="box-header with-border">
			<form action="<?php echo site_url(Backend_URL . 'member'); ?>" class="form-inline" method="get">
				<?php if(in_array($role_id,[3,4])){?>
					<div class="row">
						<div class="col-md-12">
							<h3 class="text-center"><?php echo $union_info->union_bn_name; ?> ইউনিয়ন পরিষদ</h3>
							<h5 class="text-center">উপজেলা: <?= $union_info->upazila_bn_name;?>, <?= $union_info->district_bn_name;?></h5>
						</div>
						<div class="col-md-offset-4 col-md-4">
							<div class="input-group">
								<input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
								<span class="input-group-btn">
									<?php if ($q != '') { ?>
										<a href="<?php echo site_url(Backend_URL . 'member'); ?>" class="btn btn-default">Reset</a>
									<?php } ?>
									<button class="btn btn-primary" type="submit">Search</button>
								</span>
							</div>
						</div>
					</div>
				<?php }else{?>
				<div class="row">

					<div class="col-md-2">
						<select name="division_id" class="form-control" id="division_id">
							<?php echo Helper::getDivisions($division_id); ?>
						</select>
					</div>
					<div class="col-md-2">
						<select name="district_id" class="form-control" id="district_id">
							<?php echo Helper::getDistricts($district_id, $division_id); ?>
						</select>
					</div>
					<div class="col-md-2">
						<select name="upazilla_id" class="form-control" id="upazilla_id">
							<?php echo Helper::getUpazilas($upazilla_id, $district_id); ?>
						</select>
					</div>
					<div class="col-md-2">
						<select name="union_id" class="form-control" id="union_id">
							<?php echo Helper::getUnions($union_id, $upazilla_id); ?>
						</select>
					</div>
					<div class="col-md-2">
						<select name="user_id" class="form-control" id="user_id">
							<?php echo Helper::getSecretaryDropDown($user_id); ?>
						</select>
					</div>
					<div class="col-md-2">
						<div class="input-group">
							<input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
							<span class="input-group-btn">
								<?php if ($q != '') { ?>
									<a href="<?php echo site_url(Backend_URL . 'member'); ?>" class="btn btn-default">Reset</a>
								<?php } ?>
								<button class="btn btn-primary" type="submit">Search</button>
							</span>
						</div>
					</div>
				</div>
				<?php }?>
			</form>

		</div>

		<div class="box-body">
			<?php echo $this->session->flashdata('message'); ?>
			<div class="table-responsive">
				<table class="table table-hover table-condensed">
					<thead>
						<tr>
							<th width="50">ক্রমিক নং</th>
							<th>ইউনিয়ন</th>
							<th>হোল্ডিং নাম্বার</th>
							<th>নাম</th>
							<th>গ্রাম/মহল্লার নাম</th>
							<th>ওয়ার্ড নং</th>
							<th>মোবাইল নং</th>
							<th>পিতা/স্বামী</th>
							<th>মাতা</th>
							<th>জন্ম তারিখ</th>
							<th>জাতীয় পরিচয়পত্র/জন্ম নিবন্ধন নং</th>
							<th>পরিবারের সদস্য সংখ্যা</th>
							<th>সামাজিক সুরক্ষার সুবিধা</th>
							<th>Creator</th>
							<th width="200">Action</th>
						</tr>
					</thead>

					<tbody>
						<?php foreach ($members as $member) { ?>
							<tr>
								<td><?php echo ++$start ?></td>
								<td><?php echo $member->union_name; ?></td>
								<td><?php echo $member->present_holding_no; ?></td>
								<td><?php echo $member->khana_chief_name_ba . ' <br/>' . $member->khana_chief_name_en; ?></td>
								<td><?php echo $member->village; ?></td>
								<td><?php echo $member->word_no; ?></td>
								<td><?php echo $member->mobile_no; ?></td>
								<td><?php echo $member->father_name; ?></td>
								<td><?php echo $member->mother_name; ?></td>
								<td><?php echo $member->date_of_birth; ?></td>
								<td><?php echo $member->nid; ?></td>
								<td><?php echo $member->house_members; ?></td>
								<td><?php echo $member->ssb_name; ?></td>
								<td><?php echo $member->full_name; ?></td>
								<td>
									<?php
									echo anchor(site_url(Backend_URL . 'member/read/' . $member->id), '<i class="fa fa-fw fa-external-link"></i> View', 'class="btn btn-xs btn-primary"');
									if((in_array($role_id, [3,4]))){
										echo anchor(site_url(Backend_URL . 'member/update/' . $member->id), '<i class="fa fa-fw fa-edit"></i> Edit', 'class="btn btn-xs btn-warning"');
									}else{
										echo anchor(site_url(Backend_URL . 'member/delete/' . $member->id), '<i class="fa fa-fw fa-trash"></i> Delete ', 'class="btn btn-xs btn-danger"');
									}
									
									?>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>


			<div class="row">
				<div class="col-md-6">
					<span class="btn btn-primary">Total Member: <?php echo $total_rows ?></span>
				</div>
				<div class="col-md-6 text-right">
					<?php echo $pagination ?>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	$(document.body).on('change', '#division_id', function() {
		var division_id = $(this).val();
		jQuery.ajax({
			url: 'user/getDivision/' + division_id,
			type: 'get',
			dataType: "json",
			beforeSend: function() {
				jQuery('#ajax_respond').html('<p class="ajax_processing">Loading....</p>');
			},
			success: function(jsonRespond) {

				if (jsonRespond.Status === 'OK') {

					jQuery('#district_id').html(jsonRespond.Msg);
				} else {
					jQuery('#ajax_respond').html(jsonRespond.Msg);
				}
			}
		});
	});

	$(document.body).on('change', '#district_id', function() {
		var district_id = $(this).val();
		jQuery.ajax({
			url: 'user/getDistrict/' + district_id,
			type: 'get',
			dataType: "json",
			beforeSend: function() {
				jQuery('#ajax_respond').html('<p class="ajax_processing">Loading....</p>');
			},
			success: function(jsonRespond) {

				if (jsonRespond.Status === 'OK') {

					jQuery('#upazilla_id').html(jsonRespond.Msg);
				} else {
					jQuery('#ajax_respond').html(jsonRespond.Msg);
				}
			}
		});
	});

	$(document.body).on('change', '#upazilla_id', function() {
		var upazilla_id = $(this).val();
		jQuery.ajax({
			url: 'user/getUpazilla/' + upazilla_id,
			type: 'get',
			dataType: "json",
			beforeSend: function() {
				jQuery('#ajax_respond').html('<p class="ajax_processing">Loading....</p>');
			},
			success: function(jsonRespond) {
				if (jsonRespond.Status === 'OK') {

					jQuery('#union_id').html(jsonRespond.Msg);
				} else {
					jQuery('#ajax_respond').html(jsonRespond.Msg);
				}
			}
		});
	});
</script>